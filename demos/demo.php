<?php

use Win32Dialog\MessageBox;
use Win32Dialog\MessageBoxButton;
use Win32Dialog\MessageBoxDefaultButton;
use Win32Dialog\MessageBoxIcon;
use Win32Dialog\MessageBoxLang;
use Win32Dialog\MessageBoxModality;

require_once __DIR__ . '/../vendor/autoload.php';

$box = new MessageBox("This is the box title!", "Are you good at programming?");
$box->addButton(MessageBoxButton::YES_NO);
$box->addIcon(MessageBoxIcon::QUESTION);
$box->addDefaultButton(MessageBoxDefaultButton::BUTTON1);
echo 'Chosen option: ';
var_dump($box->render());

$box = new MessageBox("The code ran ok", "What do you wanna do now?");
$box->addButton(MessageBoxButton::ABORT_RETRY_IGNORE);
$box->addIcon(MessageBoxIcon::WARNING);
$box->addDefaultButton(MessageBoxDefaultButton::BUTTON3);
echo 'Chosen option: ';
var_dump($box->render());

$box = new MessageBox("This should have chinese text buttons", "Take a look");
$box->addButton(MessageBoxButton::OK);
$box->addButton(MessageBoxButton::HELP);
$box->addIcon(MessageBoxIcon::WARNING);
$box->addDefaultButton(MessageBoxDefaultButton::BUTTON3);
$box->addLanguage(MessageBoxLang::JAPANESE);
$box->addModality(MessageBoxModality::SYSTEM);
echo 'Chosen option: ';
var_dump($box->render());
