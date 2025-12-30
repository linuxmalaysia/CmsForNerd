# 🪟 Windows 11 Environment Setup

Professional toolchain configuration for the **CMSForNerd v3.3** Laboratory.

## Recommended Toolchain
* **Web Engine:** Laravel Herd (Select PHP 8.4)
* **Terminal:** Antigravity or Windows Terminal
* **Editor:** VS Code with "PHP Intelephense" extension

## Important: Symbolic Links
When installing **Git for Windows**, you MUST check the box for **"Enable symbolic links"**. Modern PHP architectures (including Composer's internal linking) depend on this feature to function correctly on the NTFS filesystem.

## Troubleshooting Path Issues
If `php -v` in your terminal shows a version older than 8.4:
1. Open Herd Settings.
2. Go to the **General** tab.
3. Click **"Add Herd to Path"**.
4. Restart your terminal.
