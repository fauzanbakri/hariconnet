#!/usr/bin/env bash
set -euo pipefail

# Commit staged changes (after adding all) with a message that is only the current datetime
TS=$(date "+%d/%m/%Y %H:%M")

git add .

# If there is nothing to commit, exit gracefully
if git diff --cached --quiet; then
  echo "No changes to commit"
else
  git commit -m "$TS"
fi

git push origin main

echo "Pushed to origin main with message: $TS"
