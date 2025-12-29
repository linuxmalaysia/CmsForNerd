# 🧪 Lab Module 1: Modern Architecture (v3.3)

> **Topic:** Modern PHP 8.4+ Architecture & PHP 9 Readiness

## 🎯 Learning Objectives
1. Eliminate boilerplate using **Constructor Property Promotion**.
2. Master **Property Hooks** to replace traditional Getters/Setters.
3. Understand **Asymmetric Visibility** for secure data encapsulation.

---

## 🛠️ Step 1: Constructor Property Promotion
Refactor the `User` class to reduce boilerplate. PHP 8.4 allows you to declare properties directly in the constructor signature.

```php
// Modern Way (PHP 8.4)
final class User {
    public function __construct(
        public readonly string $username,
        public private(set) string $role = 'student'
    ) {}
}
```
#### Part 2: Property Hooks and Asymmetric Visibility
```markdown
## 🧪 Step 2: Implementing Property Hooks
Property hooks allow you to intercept the "Get" or "Set" action. Use this in your `CmsContext` to automate data validation.

```php
public string $pageTitle {
    get => ucfirst($this->pageTitle);
    set => $this->pageTitle = trim($value);
}
```

##🔐 Step 3: Asymmetric Visibility

Set a property to be Publicly Readable but Privately Writable using public private(set). This ensures that internal logic can update a state (like a view counter) while preventing external tampering.
✅ Step 4: Verification

Run your compliance tool in the terminal: composer check-style

Question: If a property is marked as readonly, can it also have a set hook? (Hint: Think about why 'Readonly' and 'Setting a value' might conflict).

---

### 🚀 Git Commands to Push to GitHub

Run these in your **Antigravity Terminal** to sync everything we've done (Sitemap, README, Welcome-Kit, Lab-Manual, and Module 1):

```bash
# 1. Stage all your refactored PHP files and new Markdown docs
git add .

# 2. Create a versioned commit message
git commit -m "Build v3.3: Refactored Module 1, Lab Manual, and finalized GitBook summary"

# 3. Push to your repository
git push origin master
