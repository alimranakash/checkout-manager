# Checkout Manager for WooCommerce

## Overview
Checkout Manager for WooCommerce is a powerful plugin that lets you fully customize your WooCommerce checkout page. It helps increase conversion rates and improve the checkout experience by allowing you to add, edit, and remove checkout fields with ease.

## Key Features
- Add, edit, and remove billing, shipping, and order fields
- Drag & drop field ordering
- Multiple field types: Text, Textarea, Select, Radio, Checkbox, Date, File Upload, and more
- Control field display on Thank You page, order emails, and admin order pages
- Customize checkout field styling
- Conditional Logic: show a field only when another field meets a specified condition
- Field Validation: phone, numeric, letters-only, alphanumeric, or custom regex
- Automatically save custom field values to WooCommerce order meta
- Import and export all plugin settings as JSON

## Pro Features
- Role and permission management for field access by user role
- Field-level permissions to lock fields from non-admin users
- Audit logs to track field changes with timestamps and users
- Advanced dynamic logic with multi-condition AND/OR rules
- Auto-calculated fields and conditional field groups
- Branching checkout paths based on customer type or product selection
- Multi-step checkout flows with progress indicators and step validation
- Abandoned cart recovery and save-progress support
- Step-specific styling, prefill templates, and advanced export options
- Optional REST API access for advanced integrations

## Installation
1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin from the `Plugins` menu in WordPress admin
3. Ensure WooCommerce is installed and active
4. Go to **Checkout Manager** from the WordPress admin menu

## Initial Setup
- Open the `Checkout Manager` settings page
- Add new fields under `Billing Fields`, `Shipping Fields`, or `Order Fields`
- Configure label, input type, status, and visibility options for each field
- If needed, enable Conditional Logic so the field appears only in specific cases
- Enable validation rules for custom fields when required
- Save your settings and verify the checkout page display

## How to Use
1. **Add a field**: Fill out the new field form, set the options, and click `Save`
2. **Edit a field**: Use the `Edit` button next to an existing field to update it
3. **Remove a field**: Click `Delete` or `Remove` next to the field you want to delete
4. **Change field order**: Drag fields into the order you want them to appear
5. **Conditional Logic**: Show a field only when another field matches a condition such as equals, not equals, contains, is empty, or is not empty
6. **Import / Export**: Use JSON export to save your settings and import them to another site

## Custom Field Data
- Custom field values are saved as WooCommerce order meta data
- Values are visible on the WooCommerce order details page, in order emails, and in the admin order screen

## Requirements
- WordPress 5.0 or higher
- PHP 5.6 or higher
- WooCommerce installed and active

## Frequently Asked Questions
### Does this plugin require WooCommerce?
Yes. WooCommerce must be installed and active for this plugin to work.

### Where are custom field values stored?
Custom field values are stored as order meta data and can be viewed in the WooCommerce order details.

### What is Conditional Logic?
Conditional Logic allows a field to appear only when another field meets a specific condition. For example, show `Company VAT` only when `Company Name` is not empty.

## Update Notes (1.1.0)
- Custom field values now save correctly to WooCommerce order meta
- Added Conditional Logic support with equals, not equals, contains, is empty, and is not empty conditions
- Added field validation options for phone, numeric, letters-only, alphanumeric, and custom regex
- Added JSON import/export for all settings
- Fixed debug and text domain issues
- Ensured field order is respected correctly on the checkout page

## Reference
- Plugin Name: Checkout Manager for WooCommerce
- Version: 1.1.0
- Author: Al Imran Akash
- Plugin URI: https://wpplugines.com/
