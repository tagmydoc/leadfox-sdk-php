# [LeadFox](https://www.leadfox.co) PHP API

A beautiful, extendable API powered by [Saloon](https://github.com/sammyjo20/saloon).

## Installation

```bash
composer require tagmydoc/leadfox-sdk-php
```

## Usage

```php
use TagMyDoc\LeadFox\LeadFoxClient;

$client = new LeadFoxClient('YOUR_API_KEY', 'YOUR_SECRET_KEY');

// Contacts API
$client->contacts()->all(email: 'example@example.com');
$client->contacts()->get('64400000f00000a0000fffff');
$client->contacts()->create('example@example.com', ['name' => 'John Smith']);
$client->contacts()->update('64400000f00000a0000fffff', ['name' => 'John Smith']);
$client->contacts()->upsert('example@example.com', ['name' => 'John Smith']);
$client->contacts()->delete('64400000f00000a0000fffff');
```

## Credits

- [Alexandre Demers](https://github.com/alexdemers)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
