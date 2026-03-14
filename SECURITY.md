# Security Policy

## Maintenance Stance
This repository is a downstream implementation maintained by **Harisfazillah Jamel (SongketMail Sdn Bhd)**. Our strategy for resiliency and sovereignty is to strictly follow the upstream baseline at [cmsfornerd/cmsfornerd](https://github.com/CMSForNerd/CmsForNerd).

## Supported Versions

We only provide support for the current master branch, which is regularly synchronised with the latest upstream stable releases.

| Version | Supported          | PHP Requirement |
| ------- | ------------------ | --------------- |
| master  | :white_check_mark: | >= 8.4          |
| < 3.0   | :x:                | < 8.3           |

## Reporting a Vulnerability

As this project prioritises synchronisation with the core engine:

1. **Upstream Vulnerabilities:** If you discover a security flaw in the core logic or dependencies, please report it directly to the upstream maintainers at [CMSForNerd Security](https://github.com/CMSForNerd/CmsForNerd/security/policy).
2. **Implementation Flaws:** If the vulnerability is specific to the `linuxmalaysia` (Harisfazillah Jamel) implementation or our specific environment configurations, please contact:
   - **Email:** linuxmalaysia@songketmail.org
   - **Protocol:** Please include a detailed description of the exploit and steps to reproduce.
   - **Response Time:** You can expect an initial acknowledgement within 48 hours.

## Disclosure Policy
We adhere to responsible disclosure. We ask that you do not share details of a suspected vulnerability publicly until we have had the opportunity to synchronise a patch from upstream or implement a local mitigation.
