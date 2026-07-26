#!/usr/bin/env bash

# ==============================================================================
# Protocol    : Deep State of Mind (DSOM) For My AI
# Author      : Harisfazillah Jamel (LinuxMalaysia)
# Timestamp   : 2026-07-26
# License     : GNU General Public License v3.0
# Standard    : UK English | DBP-standard Bahasa Melayu Malaysia (Piawai)
# ==============================================================================
# CmsForNerd Staging Deployment Wrapper
set -e

echo "[+] Executing local pre-flight checks (PHPStan Level 8 Zero-Debt)"
composer lab-check || { echo "[-] Pre-flight analysis failed. Aborting deployment."; exit 1; }

echo "[+] Deploying CMSForNerd to staging array..."
ansible-playbook deploy.yml -i inventory/hosts.staging.yml --ask-vault-pass

echo "[+] Deployment successful. Executing post-deploy semantic audit."
curl -s -o /dev/null -w "%{http_code}" https://staging.cmsfornerd.local/ | grep -q 200 || { echo "[-] Sanity check failed (Not 200 OK)"; exit 1; }
echo "[+] Target routing verified (200 OK)."
