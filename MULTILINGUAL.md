# Multilingual Support - PayYoga

This document explains how to use and extend the multilingual support in the PayYoga application.

## Overview

The application supports three languages:
- **English (en)** - Default language
- **Romanian (ro)** - Română
- **Russian (ru)** - Русский

## How It Works

### Language Switching

Users can switch languages using the language selector dropdown in the navigation bar on any page. The selected language is stored in the session and persists across page visits.

### Implementation Details

1. **Language Files** - Located in `resources/lang/`
   - Each language has its own directory: `en/`, `ro/`, `ru/`
   - Translation strings are stored in `.php` files that return associative arrays

2. **Middleware** - `App\Http\Middleware\SetLocale`
   - Automatically sets the application locale from the session
   - Defaults to English if no language is selected

3. **Controller** - `App\Http\Controllers\LanguageController`
   - Handles language switching via the `/language/{locale}` route
   - Validates the locale before saving to session

4. **Routes** - `routes/web.php`
   - `/language/{locale}` - Route for changing language

## Using Translations in Templates

### Basic Usage

Use the `__()` helper function to retrieve translation strings:

```blade
{{ __('messages.welcome') }}
```

This will return the translation from `resources/lang/{current-locale}/messages.php`

### Translation File Structure

Example from `resources/lang/en/messages.php`:

```php
<?php

return [
    'welcome' => 'Welcome to PayYoga',
    'find_your_flow' => 'Find Your Flow',
    'discover' => 'Discover the perfect yoga plan for your lifestyle',
    // ... more strings
];
```

## Adding New Translations

To add a new translatable string:

1. **Add to all language files** - Add the same key to `resources/lang/en/messages.php`, `resources/lang/ro/messages.php`, and `resources/lang/ru/messages.php`

Example:
```php
// resources/lang/en/messages.php
'new_feature' => 'New Feature Text',

// resources/lang/ro/messages.php
'new_feature' => 'Text pentru noua caracteristică',

// resources/lang/ru/messages.php
'new_feature' => 'Текст для новой функции',
```

2. **Use in template**:
```blade
{{ __('messages.new_feature') }}
```

## Adding a New Language

To add support for a new language (e.g., German):

1. **Create language directory**:
   ```bash
   mkdir resources/lang/de
   ```

2. **Create translation files**:
   - Copy `resources/lang/en/messages.php` to `resources/lang/de/messages.php`
   - Translate all strings

3. **Update LanguageController** - Add the new locale to the validation:
   ```php
   if (!in_array($locale, ['en', 'ro', 'ru', 'de'])) {
       $locale = 'en';
   }
   ```

4. **Update SetLocale Middleware** - Add the new locale:
   ```php
   if (!in_array($locale, ['en', 'ro', 'ru', 'de'])) {
       $locale = 'en';
   }
   ```

5. **Update Language Selector** - Add option to the select in blade templates:
   ```blade
   <option value="de" {{ app()->getLocale() === 'de' ? 'selected' : '' }}>Deutsch</option>
   ```

## Language-Specific Features

### HTML Lang Attribute

All templates include the proper HTML lang attribute:
```blade
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
```

This ensures correct language declaration for accessibility and SEO.

## Session Management

The selected language is stored in the session key `locale`. To programmatically set the language:

```php
session(['locale' => 'ro']);
```

To retrieve the current language:

```php
$currentLocale = session('locale', config('app.locale', 'en'));
```

## Configuration

The default language is configured in `config/app.php`:

```php
'locale' => env('APP_LOCALE', 'en'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
```

You can override these in your `.env` file:

```
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
```

## Files Modified for Multilingual Support

- `bootstrap/app.php` - Registered SetLocale middleware
- `app/Http/Controllers/LanguageController.php` - New controller for language switching
- `app/Http/Middleware/SetLocale.php` - New middleware for setting locale
- `routes/web.php` - Added language switching route
- `resources/lang/en/messages.php` - English translations
- `resources/lang/ro/messages.php` - Romanian translations
- `resources/lang/ru/messages.php` - Russian translations
- `resources/views/welcome.blade.php` - Updated with translations and language selector
- `resources/views/about.blade.php` - Updated with translations and language selector
- `resources/views/schedule.blade.php` - Updated with translations and language selector

## Testing

To test the language switching:

1. Open the application in your browser
2. Click on the language selector dropdown in the navigation
3. Select a different language
4. Verify that the content updates to the selected language
5. Navigate to other pages and confirm the language persists

## Troubleshooting

### Translations Not Showing

- Ensure the translation key exists in the language file
- Check that the locale is properly set (use `app()->getLocale()` to verify)
- Clear the application cache: `php artisan cache:clear`

### Language Not Persisting

- Verify sessions are enabled in `config/session.php`
- Check that the SetLocale middleware is registered
- Ensure cookies are enabled in the browser

### Missing Translations

If a translation key is not found, Laravel will display the key itself. To provide a fallback, you can use the optional parameter:

```blade
{{ __('messages.missing_key', 'Fallback text') }}
```

## Best Practices

1. **Keep translations organized** - Use logical grouping in files (e.g., `messages.php` for general messages)
2. **Use descriptive keys** - Use keys that describe the content (e.g., `nav_about` instead of `text1`)
3. **Maintain consistency** - Keep the same number of strings in all language files
4. **Use interpolation** - For dynamic content, use Laravel's translation features:
   ```php
   'welcome_message' => 'Welcome, :name!',
   ```
   Then in the template:
   ```blade
   {{ __('messages.welcome_message', ['name' => $userName]) }}
   ```

## Additional Resources

- [Laravel Localization Documentation](https://laravel.com/docs/localization)
- [Laravel Sessions](https://laravel.com/docs/session)
