# 🐧 Linux Environment Setup (v3.3)

Standardizing the PHP 8.4 installation across Linux distributions for the CMSForNerd Laboratory.

## Repository Standards
To support **PHP 8.4 Property Hooks**, we utilize "Bleeding Edge" repositories that provide stable, audited builds for production.

### Debian / Ubuntu LTS
We use the **deb.sury.org** repository. 
* **Key Benefit:** Supports multiple PHP versions side-by-side.
* **Security:** GPG signed and maintained by the primary PHP maintainer for Debian.

### AlmaLinux / RHEL 9
We use the **Remi Repository**.
* **Key Benefit:** Native DNF module stream support.
* **Security:** Follows enterprise-grade packaging standards.

## Permission Hardening
Web servers (Nginx/Apache) must never have write access to the CMS core unless explicitly required for `uploads/` directories.
