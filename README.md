# link_shortener
 A project made with laravel and vue js to create a global url shortener

## Stack
Laravel , Vue  2, Tailwind 

### Malicious Site Links
Go to https://testsafebrowsing.appspot.com/  to find malicious site links

#### Link Generation
1. Go to [[your_url]]/link-generator 
2. A shortened version of a longer url can be created from here.
3. The shorened url can be used to share to people. After clicking , it will be redireced to the original url

If the Original given url is empty/invalid/malicious , exeption(s) will be shown

#### How to run
Just run it like a laravel project by hitting url, not with serve
_Vue was integrated using laravel mixin, so you will not be able to run the frontend using serve_
import the link_ shortener.sql file (You may truncate the links table if you want to start fresh)

#### Does this allow subfolder
Yes, it does run on a subfolder
in .env file if there is no subfolder , make sure the variables are like this

BASENAME="/"
MIX_ASSET_URL="/public"


BASENAME="/link_shortener"
MIX_ASSET_URL="/link_shortener/public"

if you have subfolder the variables should be like:

BASENAME="/[path/to/subfolder]"
MIX_ASSET_URL="/[path/to/subfolder]/public"


