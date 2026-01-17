namespace App\public;

require_once __DIR__ . '/../vendor/autoload.php';

function dump_die($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
