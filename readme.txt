=== Checkout Manager ===
Contributors: al-imran-akash
Tags: woocommerce checkout manager, woocommerce checkout editor, woocommerce checkout fields editor, woocommerce, woocommerce checkout, checkout, checkout editor
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 1.1.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Checkout Manager - The most advanced and powerful customization of your checkout page.

== Description ==
Checkout Manager for WooCommerce is an excellent tool to increase your conversion rates and boost your sales.
It allows you to add, edit, customize, and delete fields on the checkout page.

= Key Features =
* Add, edit, and remove billing, shipping, and order fields
* Drag & drop field ordering
* Multiple field types: Text, Textarea, Select, Radio, Checkbox, Date, File Upload, and more
* Control field display on Thank You page, order emails, and admin order pages
* Style customization for checkout input fields
* **[NEW]** Conditional Logic — show a field only when another field meets a condition
* **[NEW]** Field Validation — phone, numeric, letters-only, alphanumeric, or custom regex
* **[NEW]** Custom field values automatically saved to WooCommerce order meta
* **[NEW]** Import / Export all plugin settings as JSON

== Installation ==
Installation is fairly straight forward. Install it from the WordPress plugin repository.

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ensure WooCommerce is installed and active
4. Navigate to **Checkout Manager** in the WordPress admin menu

== Frequently Asked Questions ==

= Does this plugin require WooCommerce? =
Yes. WooCommerce must be installed and active.

= Where are my custom field values saved? =
Custom field values are saved as order meta data and are visible in the WooCommerce admin order detail page.

= What is Conditional Logic? =
Conditional Logic lets you show a custom checkout field only when another field meets a specified condition (e.g. show "Company VAT" only if "Company Name" is not empty).

== Screenshots ==
1. screenshot-1
2. screenshot-2
3. screenshot-3
4. screenshot-4
5. screenshot-5
6. screenshot-6
7. screenshot-7
8. screenshot-8
9. screenshot-9

== Changelog ==

= 1.1.0 - 2026-04-12 =
* [new] Custom field values are now properly saved to WooCommerce order meta
* [new] Conditional Logic — show a field only if another field matches a condition (equals, not equals, contains, is empty, is not empty)
* [new] Field Validation — validate custom fields as phone, numeric, letters-only, alphanumeric, or custom regex pattern
* [new] Import / Export all plugin settings as a JSON file (Settings → Import / Export tab)
* [fix] Text domain unified to `checkout-manager` throughout the plugin
* [fix] `imcm_enable_debug()` no longer crashes when troubleshoot option is not yet saved
* [fix] WooCommerce built-in validation rules (email, phone) are now preserved for default fields
* [fix] Field priority order is now correctly respected on the checkout page

= 1.0.2 - 2022-04-21 =
* [fix] Fixed error.

= 1.0.1 - 2022-04-20 =
* [fix] Add display position, style option and fixed display all custom fields in thankyou page, order details page and emails

= 1.0.0 - 2022-04-05 =
* [fix] Display fixed in thankyou page, order details page and emails

= 0.9 =
* Initial version release