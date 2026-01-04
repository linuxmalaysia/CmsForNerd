#!/bin/bash
# ==============================================================================
# CMSForNerd v3.5 - AI Intelligence Audit (Pre-Flight)
# Author: Haris Fazillah (ezidea.co)
# Purpose: Ensure AI State of Mind is synced with Physical Reality (Git)
# ==============================================================================

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}>>> Starting Intelligence Audit (State Sync)...${NC}"

# 1. Check Brain Artifacts Existence
# Ensures critical 'Brain' files are in place.
FILES=(".agent/brain/task.md" ".agent/brain/walkthrough.md" "docs/AI-STATE-SYNC.md")
for file in "${FILES[@]}"; do
    if [ ! -f "$file" ]; then
        echo -e "${RED}[ERROR] Critical file $file not found!${NC}"
        exit 1 # Fail if 'Brain' file is missing.
    fi
done

# 2. Check Remote Drift (Git Reality Check)
# Compares local HEAD with remote to detect differences.
echo -e "${YELLOW}>>> Checking alignment with Git Remote...${NC}"
git fetch origin --quiet # Fetch remote data without verbose output
LOCAL=$(git rev-parse HEAD) # Local commit hash
REMOTE=$(git rev-parse @{u}) # Remote commit hash

if [ "$LOCAL" != "$REMOTE" ]; then
    echo -e "${RED}[WARNING] Local HEAD differs from Origin!${NC}"
    echo -e "${YELLOW}Please run 'git pull' or sync Brain Artifacts first.${NC}"
    # Do not exit 1 here to allow offline work flexibility,
    # but the agent will be clearly warned.
else
    echo -e "${GREEN}[OK] Git State is in-sync.${NC}"
fi

# 3. Check task.md Integrity (Task Decay)
# Ensures there are unfinished or ongoing tasks for the agent.
IN_PROGRESS=$(grep -c "\[/\]" .agent/brain/task.md) # Tasks in progress
TODO=$(grep -c "\[ \]" .agent/brain/task.md) # Tasks not started

echo -e ">>> Task Status: ${GREEN}$IN_PROGRESS In-Progress${NC}, ${YELLOW}$TODO Pending${NC}"

if [ "$IN_PROGRESS" -eq 0 ] && [ "$TODO" -eq 0 ]; then
    echo -e "${RED}[WARNING] task.md is empty or all tasks completed. Please update with new objectives.${NC}"
    # Do not exit 1 because this might be a valid scenario if the project is finished.
fi

# 4. Check PHP 8.4 Environment
# Confirms the required PHP version for the project.

echo "DEBUG: Checking for PHP executable..."
if ! command -v php &> /dev/null; then
    echo -e "${YELLOW}[WARNING] 'php' command not found in bash PATH. PHP version check skipped.${NC}"
else
    # Try to get version
    PHP_VER=$(php -v | head -n 1 | awk '{print $2}' | cut -d. -f1,2)
    
    if [ -z "$PHP_VER" ]; then
        echo -e "${YELLOW}[WARNING] Failed to read 'php -v' output. Version check skipped.${NC}"
    else
        echo -e ">>> Detected PHP Version: '${YELLOW}$PHP_VER${NC}'"
        # Use pattern matching for flexibility (e.g. 8.4.x is OK if 8.4 detected)
        if [[ "$PHP_VER" != "8.4"* ]]; then
            echo -e "${RED}[ERROR] Environment is not PHP 8.4 (Current: '$PHP_VER')${NC}"
            exit 1 # This is a critical error.
        fi
    fi
fi

echo -e "${GREEN}>>> Intelligence Audit Complete. State of Mind recognized as VALID.${NC}"
exit 0 # Success
