namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Username implements Rule
{
    public function passes($attribute, $value)
    {
        // Your logic to validate the username (e.g., regex, length, etc.)
        return preg_match('/^[a-zA-Z0-9_]{3,15}$/', $value); // Example: Alphanumeric with underscores, 3-15 chars
    }

    public function message()
    {
        return 'The :attribute must be a valid username.';
    }
}
