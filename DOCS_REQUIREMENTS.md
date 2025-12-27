# Architecture Requirements (RFC 2119)

This document defines the "Laws of the Project" using the requirement levels described in RFC 2119.

## Core Logic Requirements

1. **Strict Typing:** All PHP files **MUST** begin with `declare(strict_types=1);`.
2. **Namespace:** All core classes **MUST** reside within the `CmsForNerd\` namespace.
3. **Global Variables:** Code **MUST NOT** rely on the `global` keyword. All shared data **MUST** be accessed via the `CmsContext` object.
4. **Dependencies:** Third-party libraries **SHOULD** be managed exclusively via Composer.

## Security Requirements

1. **Input:** The `page` parameter **MUST** be sanitized using `preg_replace` to prevent directory traversal.
2. **Output:** All user-provided strings **MUST** be escaped using `htmlspecialchars()` before being rendered in the theme.
3. **Sessions:** Sessions **SHOULD** be configured with `cookie_httponly` set to true.

## Documentation & Educational Requirements

1. **Modernization History:** For every major improvement or architectural change, the `contents/history-body.inc` file **MUST** be updated with a summary of the change. This is REQUIRED for training, education, and maintaining a clear project pedigree.
2. **Teaching Mode:** Comments added to code **SHOULD** explain the *why* (rationale) behind the implementation to serve as a learning resource for others.
