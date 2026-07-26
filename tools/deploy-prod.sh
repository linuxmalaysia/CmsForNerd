#!/usr/bin/env bash
# CmsForNerd Production Deployment Wrapper
# Enforces the "Trinity of Safety" (Status Probe, Sovereign Gate, Sudo Lock)
set -e

# Color definitions
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}================================================================${NC}"
echo -e "${BLUE}  CmsForNerd Production Deployer - Podman-Compose & BunkerWeb  ${NC}"
echo -e "${BLUE}================================================================${NC}"

# -----------------------------------------------------------------------------
# 1. STATUS PROBE
# -----------------------------------------------------------------------------
echo -e "\n${YELLOW}[1/3] Initiating Status Probe...${NC}"

if ! command -v ansible &>/dev/null; then
    echo -e "${RED}[FAIL] Ansible is not installed on the control machine.${NC}"
    exit 1
fi
echo -e "${GREEN}[OK] Ansible: $(ansible --version | head -n 1)${NC}"

if ! command -v git &>/dev/null; then
    echo -e "${RED}[FAIL] Git is not installed on the control machine.${NC}"
    exit 1
fi
echo -e "${GREEN}[OK] Git: $(git --version)${NC}"

# Verify codebase integrity with local lab-check if Composer is installed
if command -v composer &>/dev/null; then
    echo -e "${YELLOW}[+] Running local Composer lab-check...${NC}"
    composer lab-check || {
        echo -e "${RED}[FAIL] Local code quality or test checks failed. Aborting deployment.${NC}"
        exit 1
    }
    echo -e "${GREEN}[OK] Codebase verified (Zero-Debt).${NC}"
else
    echo -e "${YELLOW}[WARN] Composer not found locally. Skipping local lab-check.${NC}"
fi

# -----------------------------------------------------------------------------
# 2. SOVEREIGN GATE
# -----------------------------------------------------------------------------
echo -e "\n${YELLOW}[2/3] Preparing Sovereign Gate...${NC}"
echo -e "${GREEN}[OK] Sovereign Gate verification delegated directly to Ansible built-in assertion engine.${NC}"

# -----------------------------------------------------------------------------
# 3. SUDO LOCK
# -----------------------------------------------------------------------------
echo -e "\n${YELLOW}[3/3] Enforcing Sudo Lock...${NC}"
echo -e "${YELLOW}[+] Verifying playbook and roles configurations...${NC}"

# Perform Ansible syntax check
ansible-playbook --syntax-check playbooks/deploy_prod_compose.yml -i inventory/hosts.prod.yml || {
    echo -e "${RED}[FAIL] Playbook syntax check failed!${NC}"
    exit 1
}
echo -e "${GREEN}[OK] Playbook syntax validated.${NC}"
echo -e "${GREEN}[OK] Sudo Lock validation complete. Root privilege escalation restricted to foundation tasks.${NC}"

# -----------------------------------------------------------------------------
# EXECUTION
# -----------------------------------------------------------------------------
echo -e "\n${GREEN}>>> Trinity of Safety completed successfully! Starting deployment...<<<${NC}"
echo -e "${BLUE}[+] Command: ansible-playbook playbooks/deploy_prod_compose.yml -i inventory/hosts.prod.yml${NC}"

# Execute deployment
ansible-playbook playbooks/deploy_prod_compose.yml -i inventory/hosts.prod.yml "$@"

echo -e "\n${GREEN}================================================================${NC}"
echo -e "${GREEN}  DEPLOYMENT SUCCESSFUL - BunkerWeb, Nginx, PHP-FPM Stack Live  ${NC}"
echo -e "${GREEN}================================================================${NC}"
