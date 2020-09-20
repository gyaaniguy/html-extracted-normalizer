<?php

use gyaani\guy\Classes\HtmlNormalizer;
use QueryPath\DOMQuery;

include __DIR__ . "/../vendor/autoload.php";

/* Variable Names and expected types to extract from html*/
$cols['last_name'] = ['last_name', 'string'];
$cols['first_name'] = ['first_name', 'string'];
$cols['password'] = ['password', 'string'];
$cols['email'] = ['email', 'string'];

$htmlNormalizer = new HtmlNormalizer();
/** @var DOMQuery $qp */
$qp = htmlqp(__DIR__ . '/aza_voyage.html');
// Use html data extracted by Querypath, convert types, filter whitespace
$dates = $qp->find('.aza-vs__filter-date');
$htmlNormalizer->setByValue($cols['last_name'], $dates->eq(2)->text());
$htmlNormalizer->setByValue($cols['first_name'], $qp->find('div[data-label="Mar 2022"]')->text());
$htmlNormalizer->setByValue($cols['password'], $qp->find('.voyage-pricing-gallery__overlay')->attr('href'));
$rawInput = $qp->find('.aza-vs__filter-date')->eq(2)->find('[data-label="Apr 2022"]')->text();
$htmlNormalizer->setByValue($cols['email'], $rawInput);

var_dump($htmlNormalizer->extractedValues);
