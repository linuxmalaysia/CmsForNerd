#!/usr/bin/env python3
# ==============================================================================
# Protocol    : Deep State of Mind (DSOM) For My AI
# Author      : Harisfazillah Jamel (LinuxMalaysia)
# Timestamp   : 2026-07-27
# License     : GNU General Public License v3.0
# Standard    : UK English | DBP-standard Bahasa Melayu Malaysia (Piawai)
# ==============================================================================
import sys
import json
import re

required = {
    "podman_cms_user": "dsom-admin",
    "podman_cms_uid": "2001",
    "podman_cms_group": "dsom-admin",
    "podman_cms_gid": "2001"
}

def load_vars_from_file(filepath):
    """
    Loads and parses variables from a YAML or JSON file.
    Uses JSON parsing if JSON, otherwise line-by-line regex parsing for YAML.
    """
    try:
        with open(filepath, "r", encoding="utf-8") as f:
            content = f.read()
        try:
            return json.loads(content)
        except json.JSONDecodeError:
            parsed = {}
            for line in content.splitlines():
                line = line.strip()
                if not line or line.startswith("#") or line.startswith("---"):
                    continue
                # Match key: value or key: "value" or key: 'value'
                match = re.match(r"^([a-zA-Z_][a-zA-Z0-9_]*)\s*:\s*\"?([^\s\"\n\']+)\"?", line)
                if match:
                    parsed[match.group(1)] = match.group(2)
            return parsed
    except Exception as e:
        print(f"Warning: Failed to load extra-vars file {filepath}: {e}")
        return {}

def main(args):
    effective_vars = {}
    ansible_success = False

    # 1. Start by running ansible-inventory
    try:
        import subprocess
        cmd = ["ansible-inventory", "-i", "inventory/hosts.prod.yml", "--list"]
        res = subprocess.run(cmd, capture_output=True, text=True)
        if res.returncode == 0:
            data = json.loads(res.stdout)
            all_vars = data.get("all", {}).get("vars", {})
            for k, v in all_vars.items():
                effective_vars[k] = str(v)

            # Check specific groups or host variables
            _meta = data.get("_meta", {})
            hostvars = _meta.get("hostvars", {})
            for host, hvars in hostvars.items():
                for k, v in hvars.items():
                    effective_vars[k] = str(v)
            ansible_success = True
        else:
            print(f"Warning: ansible-inventory returned non-zero status: {res.stderr.strip()}")
    except Exception as e:
        print(f"Warning: ansible-inventory failed to execute: {e}")

    # 2. Fallback to parsing inventory file with regex if ansible-inventory failed
    if not ansible_success:
        print("Attempting fallback YAML parsing of inventory/hosts.prod.yml...")
        try:
            with open("inventory/hosts.prod.yml", "r", encoding="utf-8") as f:
                content = f.read()
                for k in required:
                    match = re.search(rf"{k}:\s*\"?([^\s\"\n\']+)\"?", content)
                    if match:
                        effective_vars[k] = match.group(1)
        except Exception as fallback_err:
            print(f"Error: Fallback YAML parsing of inventory/hosts.prod.yml failed: {fallback_err}")

    # Incorporate command-line overrides from args
    extra_vars_list = []
    for i, arg in enumerate(args):
        if arg == "-e" or arg == "--extra-vars":
            if i + 1 < len(args):
                extra_vars_list.append(args[i+1])
        elif arg.startswith("--extra-vars="):
            extra_vars_list.append(arg.split("=", 1)[1])
        elif arg.startswith("-e"):
            extra_vars_list.append(arg[2:])

    for evar in extra_vars_list:
        # Detect @filename inputs
        if evar.startswith("@"):
            filepath = evar[1:]
            file_vars = load_vars_from_file(filepath)
            for k, v in file_vars.items():
                effective_vars[k] = str(v)
        elif evar.startswith("{"):
            try:
                parsed = json.loads(evar)
                for k, v in parsed.items():
                    effective_vars[k] = str(v)
            except Exception as parse_err:
                print(f"Warning: Failed to parse JSON extra-vars: {parse_err}")
        else:
            pairs = re.findall(r"([a-zA-Z_][a-zA-Z0-9_]*)=([^=\s]+)", evar)
            for k, v in pairs:
                v = v.strip("\"").strip("'")
                effective_vars[k] = v

    # Fail if effective_vars is completely empty
    if not effective_vars:
        print("\033[0;31m[FAIL] Inventory verification failed: No inventory variables could be loaded from either source.\033[0m")
        sys.exit(1)

    # Validate identities
    violations = 0
    for k, expected in required.items():
        val = effective_vars.get(k)
        if val is not None:
            if val != expected:
                print(f"\033[0;31m[FAIL] Identity Standard violation: {k} is overridden to {val} (expected: {expected})")
                violations += 1

    if violations > 0:
        print("\033[0;31m[FAIL] Conflicting overrides detected. Aborting deployment to preserve Sovereign Gate.\033[0m")
        sys.exit(1)

    print("\033[0;32m[OK] Sovereign Gate validation complete. Identities are locked to dsom-admin:2001:2001.\033[0m")
    sys.exit(0)

if __name__ == "__main__":
    main(sys.argv[1:])
