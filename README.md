#### Purpose
 Convert html fragments to useable data according to format. Super basic 'library' I (plan to) use for scraping.   
Also practice git, composer, testing while creating something useful!
 
Ideally to use with Querypath DOM parser. Not a requirement. 
 
#### Status
- Unit Tests have been added.  
- Handles types: float, double, int, text.
- Collapses and trims whitespace, including annoying unicode spaces. Untested.

   
#### Usage
 
setByValue() Expects: HTML text, ReturnType. Sets return $cols arr   

```php
$htmlNormalizer->setByValue($cols['last_name'], $dates->eq(2)->text());
$htmlNormalizer->setByValue($cols['first_name'], $qp->find('div[data-label="Mar 2022"]')->text());
$htmlNormalizer->setByValue($cols['password'], $qp->find('.voyage-pricing-gallery__overlay')->attr('href'));

var_dump($htmlNormalizer->extractedValues);
```
getNormalizedValue() - simply return after formatting.
$properText = $htmlNormalizer->getNormalizedValue($rawInput, 'text');


#### Todo
- Handle `&nbsp;` char as space
- test unicode whitespace chars
- function to convert latin chars to english
- Proper APi docs instead of dumping into readme.