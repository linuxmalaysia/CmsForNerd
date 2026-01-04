# 🤖 Bot Intelligence: Hybrid Protection (v3.5)

To maintain a "Zero-Error" laboratory, we use a hybrid bot detection system. This ensures that legitimate crawlers (Google, Bing, Apple) are recognized even if their User-Agents are stripped, while keeping performance lean.

## 1. How IPs are Populated

The project uses a local database located at [data/trusted-bots.json](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/data/trusted-bots.json). This file is populated in two ways:

### Automated Update
The `update_trusted_bot_ips()` function in [is_bot.php](file:///d:/Users/LinuxMalaysia/CMSForNerd-Project/CmsForNerd/includes/is_bot.php) connects to the following official endpoints:
- **Google**: `https://developers.google.com/search/apis/ipranges/googlebot.json`
- **Bing**: `https://www.bing.com/toolbox/bingbot.json`
- **Apple**: Official HT204683 documentation prefixes.

### Manual Update
Developers can manually add IP ranges or override classifications by editing `data/trusted-bots.json`.

**JSON Format Example:**
```json
{
  "updated": "2026-01-04T12:00:00+08:00",
  "bots": [
    {
      "name": "Google",
      "prefixes": ["66.249.64.0/19", "2001:4860:4801::/48"]
    },
    {
      "name": "Manual-Override",
      "prefixes": ["192.168.1.100/32"]
    }
  ]
}
```

## 2. Performance Safeguards

1. **Localhost Exclusion**: Requests from `127.0.0.1` or `::1` bypass all checks immediately.
2. **Static Result Cache**: The result of `is_bot()` is stored in a static variable. Subsequent calls in the same request cost 0ms.
3. **Lazy Loading**: The IP list is ONLY loaded from disk if the User-Agent matches a "potential bot" pattern, or if a security threshold is triggered.

## 3. Maintenance

Regularly run `composer update-bots` (if implemented) or manually trigger the update function to keep the CIDR ranges current.
