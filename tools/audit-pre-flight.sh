#!/bin/bash

# ==============================================================================
# Protocol    : Deep State of Mind (DSOM) For My AI Protocol (v5.0 - CMSForNerd Hybrid)
# Author      : Harisfazillah Jamel (LinuxMalaysia)
# Timestamp   : 2026-07-27
# License     : GNU General Public License v3.0
# Standard    : UK English | DBP-standard Bahasa Melayu Malaysia (Piawai)
# Purpose     : Ensure AI State of Mind is synced with Physical Reality (Git, PHP, Ansible)
# ==============================================================================
set -e

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

# Find the Git root directory
ROOT_DIR=$(git rev-parse --show-toplevel 2>/dev/null)
if [ -z "$ROOT_DIR" ]; then
    echo -e "${RED}[ERROR] Audit failed: Not a git repository.${NC}"
    exit 1
fi

BRAIN_DIR="$ROOT_DIR/.agents/brain"

echo -e "${CYAN}==================================================${NC}"
echo -e "${CYAN}   DEEP STATE OF MIND (DSOM) INTELLIGENCE AUDIT   ${NC}"
echo -e "${CYAN}   Project Root: $ROOT_DIR${NC}"
echo -e "${CYAN}==================================================${NC}"

# 1. BRAIN CHECK
echo -e "${YELLOW}Step 1: Checking AI Brain Artifacts...${NC}"
REQUIRED_FILES=("task.md" "walkthrough.md")

for file in "${REQUIRED_FILES[@]}"; do
    if [ ! -f "$BRAIN_DIR/$file" ]; then
        echo -e "${RED}[ERROR] Missing Brain Artifact: $BRAIN_DIR/$file${NC}"
        echo -e "${YELLOW}Hint: Run ./tools/init-brain.sh to restore artifacts.${NC}"
        exit 1
    fi
done
echo -e "${GREEN}[PASS] AI Brain artifacts are present.${NC}"

# 2. GIT DRIFT CHECK
echo -e "\n${YELLOW}Step 2: Checking Version Control Sync...${NC}"
git -C "$ROOT_DIR" fetch origin > /dev/null 2>&1 || true
LOCAL=$(git -C "$ROOT_DIR" rev-parse @)
REMOTE=$(git -C "$ROOT_DIR" rev-parse @{u} 2>/dev/null || echo "")

if [ -z "$REMOTE" ]; then
    echo -e "${YELLOW}[SKIP] No upstream found. Working in local mode.${NC}"
elif [ "$LOCAL" != "$REMOTE" ]; then
    echo -e "${RED}[WARNING] Git Drift detected! Local and Remote are out of sync.${NC}"
    echo -e "${YELLOW}Please run 'git pull' to align your state.${NC}"
else
    echo -e "${GREEN}[PASS] Git state is synchronized.${NC}"
fi

# 3. ENVIRONMENT DISCOVERY & PHP 8.4/8.3 ENFORCEMENT
echo -e "\n${YELLOW}Step 3: Discovering Language Environment & Verifying PHP...${NC}"
if [ -f "$ROOT_DIR/composer.json" ]; then
    echo -e "${CYAN}[DETECTED] PHP Project.${NC}"
fi

if ! command -v php &> /dev/null; then
    echo -e "${YELLOW}[WARNING] 'php' command not found in bash PATH. PHP version check skipped.${NC}"
else
    # Try to get version
    PHP_VER=$(php -v | head -n 1 | awk '{print $2}' | cut -d. -f1,2)
    
    if [ -z "$PHP_VER" ]; then
        echo -e "${YELLOW}[WARNING] Failed to read 'php -v' output. Version check skipped.${NC}"
    else
        echo -e ">>> Detected PHP Version: '${YELLOW}$PHP_VER${NC}'"
        # Support only PHP 8.4+ in local development sandbox environment
        if [[ "$PHP_VER" != "8.4"* ]]; then
            echo -e "${RED}[ERROR] Environment is not PHP 8.4+ (Current: '$PHP_VER')${NC}"
            exit 1 # This is a critical error.
        else
            echo -e "${GREEN}[PASS] PHP version is compliant ($PHP_VER).${NC}"
        fi
    fi
fi

# 4. COGNITIVE TWIN PROTOCOL CHECK
echo -e "\n${YELLOW}Step 4: Checking Cognitive Twin Protocol...${NC}"
TWIN_PATH="$ROOT_DIR/docs/governance/AI-COGNITIVE-TWIN-PROTOCOL.md"
if [ ! -f "$TWIN_PATH" ]; then
    # Fallback to check legacy root docs path
    TWIN_PATH="$ROOT_DIR/docs/AI-COGNITIVE-TWIN-PROTOCOL.md"
fi

if [ -f "$TWIN_PATH" ]; then
    # Check if it still has unfilled placeholders
    if grep -q "\[YOUR_PROJECT_NAME\]" "$TWIN_PATH"; then
        echo -e "${YELLOW}[WARNING] AI-COGNITIVE-TWIN-PROTOCOL.md exists but still has [PLACEHOLDER] values.${NC}"
        echo -e "${YELLOW}          Fill in all [YOUR_*] fields to configure the Cognitive Twin for this project.${NC}"
    else
        echo -e "${GREEN}[PASS] AI-COGNITIVE-TWIN-PROTOCOL.md exists and appears configured.${NC}"
    fi
else
    echo -e "${RED}[WARNING] docs/governance/AI-COGNITIVE-TWIN-PROTOCOL.md is MISSING.${NC}"
    echo -e "${YELLOW}          Copy from the DSOM skeleton and fill in your project details.${NC}"
fi

# 5. ANSIBLE BASELINE CHECK
echo -e "\n${YELLOW}Step 5: Checking Ansible Baseline...${NC}"
ANSIBLE_OK=1

if ! command -v ansible &>/dev/null; then
    echo -e "${YELLOW}[SKIP] Ansible not installed — skipping Ansible checks (non-infra project or setup pending).${NC}"
    ANSIBLE_OK=0
else
    echo -e "${GREEN}[OK] Ansible: $(ansible --version | head -1)${NC}"
    if [ -f "$ROOT_DIR/inventory/hosts.yml" ]; then
        echo -e "${GREEN}[OK] inventory/hosts.yml exists.${NC}"
    else
        echo -e "${YELLOW}[WARN] inventory/hosts.yml missing.${NC}"
    fi
    if [ -f "$ROOT_DIR/ansible.cfg" ]; then
        echo -e "${GREEN}[OK] ansible.cfg exists.${NC}"
    else
        echo -e "${YELLOW}[WARN] ansible.cfg missing.${NC}"
    fi
fi

# 6. Check task.md Integrity (Task Decay)
echo -e "\n${YELLOW}Step 6: Checking task.md Integrity...${NC}"
IN_PROGRESS=$(grep "\[ / \]" "$BRAIN_DIR/task.md" | wc -l) # Tasks in progress
TODO=$(grep "\[ \]" "$BRAIN_DIR/task.md" | wc -l) # Tasks not started

echo -e ">>> Task Status: ${GREEN}$IN_PROGRESS In-Progress${NC}, ${YELLOW}$TODO Pending${NC}"

if [ "$IN_PROGRESS" -eq 0 ] && [ "$TODO" -eq 0 ]; then
    echo -e "${RED}[WARNING] task.md is empty or all tasks completed. Please update with new objectives.${NC}"
fi

echo -e "\n${GREEN}==================================================${NC}"
echo -e "${GREEN}   AUDIT COMPLETE: DSOM SECURED & READY FOR FLOW  ${NC}"
echo -e "${GREEN}   Protocol v5.0-CMSForNerd | GitOps · AIOps      ${NC}"
echo -e "${GREEN}==================================================${NC}"

exit 0 # Success
