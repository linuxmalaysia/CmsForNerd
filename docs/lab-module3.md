# 🛡️ Lab Module 3: Defensive Engineering (v3.3)

> **Topic:** Perimeter Security & XSS Neutralization

## 🎯 Learning Objectives
1. Understand **Defense-in-Depth** (Layered Security).
2. Eliminate **Path Traversal** using allowlist sanitization.
3. Configure **Content Security Policy (CSP)** with Nonces.
4. Implement **Bot Defense** via Cloudflare Turnstile.

---

## 🧪 Step 1: Input Hardening (Path Traversal)
Legacy PHP was vulnerable to `../` attacks. We now enforce strict alphanumeric sanitization.

**Task:** Verify your `SecurityUtils.php` contains the following logic:
```php
public static function sanitizePageName(string $pageName): string
{
    // ONLY allow alphanumeric characters and hyphens.
    return preg_replace('/[^a-zA-Z0-9\-]/', '', $pageName);
}
```
#### Part 2: CSP Nonces
```markdown
## 🛡️ Step 2: CSP Nonces
A **Nonce** (Number used once) is a unique token generated for every page load. Even if an attacker injects a `<script>`, the browser will block it because it lacks the valid nonce.

### The Verification Loop
1.  **Generate:** `SecurityUtils::generateNonce()` creates the token.
2.  **Store:** Stored in `$ctx->cspNonce`.
3.  **Deliver:** Sent via `Content-Security-Policy` header.
4.  **Validate:** The browser only runs `<script nonce="...">` tags that match.

**Live Challenge:** Try to inject an alert into your console:
`var s = document.createElement('script'); s.textContent = 'alert(1)'; document.body.appendChild(s);`
*Result: The browser must block this with a CSP violation error.*

---

## ⚖️ RFC 2119 Standards for Module 3
* **MUST:** All external assets (scripts/fonts) must be explicitly allowlisted.
* **MUST:** Use `https://` for all external resources.
* **SHOULD:** Avoid `'unsafe-inline'` in production.