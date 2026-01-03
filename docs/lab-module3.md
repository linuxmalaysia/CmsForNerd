# 🛡️ Lab Module 3: Defensive Engineering (v3.5)

> **Topic:** Perimeter Security & XSS Neutralization

---

## 🎯 Learning Objectives
1. Understand **Defense-in-Depth** (Layered Security).
2. Eliminate **Path Traversal** vulnerabilities using allowlist sanitization.
3. Configure a **Content Security Policy (CSP)** to neutralize XSS using Nonces.
4. Implement **Bot Defense** using Cloudflare Turnstile.

---

## ⚠️ Requirement Level
Students **MUST** successfully implement a "Level 2" CSP and secure the file loader to achieve "Green-Light" status.

---

## 🧱 Layer 1: The "Defense-in-Depth" Concept

Security is like an onion. In CmsForNerd, we use three primary layers:
1. **The Code Layer:** Sanitizing inputs (e.g., using `SecurityUtils`).
2. **The Browser Layer:** Using CSP to tell the browser what scripts to trust.
3. **The Network Layer:** Using Turnstile to block automated bots.

---

## 🧪 Layer 2: Input Hardening (Path Traversal)

**Legacy Vulnerability:**
```php
// VULNERABLE CODE - DO NOT USE
$page = $_GET['page'];
include "contents/" . $page . ".php";
```

**Exercise:** Open `includes/SecurityUtils.php` and verify that `sanitizePageName()` is used to neutralize non-alphanumeric characters.
```php
public static function sanitizePageName(string $pageName): string
{
    // MUST: Only allow alphanumeric characters and hyphens.
    return preg_replace('/[^a-zA-Z0-9\-]/', '', $pageName);
}
```

---

## 🛡️ Layer 3: CSP Nonces - XSS Protection

A **nonce** (number used once) is a unique token generated for every page load. Even if an attacker injects a `<script>`, the browser will block it because it lacks the valid nonce.

### The Verification Loop
1.  **Generate:** `SecurityUtils::generateNonce()` creates a 128-bit random token.
2.  **Store:** Stored in `$ctx->cspNonce`.
3.  **Deliver:** Sent via the `Content-Security-Policy` header in `common-headertag.inc`.

### 🔬 Live Challenge: Attack Your Own Site!
1. Open your browser's DevTools (**F12**).
2. Go to the **Console** tab.
3. Try to inject a script:
```javascript
var script = document.createElement('script');
script.textContent = 'alert("I hacked you!");';
document.body.appendChild(script);
```
4. **Expected Result:** The browser should block this with a CSP violation error.

---

## 🤖 Layer 4: Implementing Turnstile (Bot Defense)

We use **Cloudflare Turnstile** to verify "humanness" without CAPTCHAs.

**Task:** Integrate the Turnstile widget into a form:
```html
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<div class="cf-turnstile" data-sitekey="your-site-key"></div>
```

---

## ✅ Step 5: The "Attack & Defend" Audit

1. **Programmatic Defense:** Run the test suite:
   `./vendor/bin/phpunit --filter it_prevents_directory_traversal_attacks`
2. **Perimeter Testing:** Try to inject an external image: `<img src="http://evil.com/trap.jpg">`.
3. **Observation:** Open your console. You **MUST** see a CSP error.

---

## ⚖️ RFC 2119 Standards Summary
* **MUST:** All external assets (scripts/fonts) **MUST** be explicitly allowed in the CSP.
* **MUST:** Use `preg_replace` to strip characters from file paths.
* **SHOULD:** Avoid using `'unsafe-inline'` in your CSP.
* **MUST NOT:** Use `http://` for external resources; only **https://** is permitted.

---

**Question:** Why is a CSP considered a "Fail-Safe" for XSS vulnerabilities?  
*(Hint: What happens if you forget to use `escapeHtml()` on a user comment?)*

[Next: Module 4 (Automated Testing)](lab-module4.md)