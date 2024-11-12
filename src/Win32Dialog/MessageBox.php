<?php

// @SupressWarnings(PHPMD.StaticAccess)

namespace Win32Dialog;

use FFI;
use FFI\CData;

class MessageBox
{
    public CData|null $windowOwner = null;
    public CData|int $language = 0x00;
    public int $properties = 0x00000000;

    public function __construct(public string|CData $title, public string|CData $content)
    {
        $this->title = WinStr::wchar($title);
        $this->content = WinStr::wchar($content);
    }

    public function addButton(MessageBoxButton $button) : MessageBox
    {
        $this->properties |= $button->value;
        return $this;
    }

    public function addIcon(MessageBoxIcon $icon) : MessageBox
    {
        $this->properties |= $icon->value;
        return $this;
    }

    public function addModality(MessageBoxModality $modality) : MessageBox
    {
        $this->properties |= $modality->value;
        return $this;
    }

    public function addDefaultButton(MessageBoxDefaultButton $defaultButton) : MessageBox
    {
        $this->properties |= $defaultButton->value;
        return $this;
    }

    public function addLanguage(MessageBoxLang $lang) : MessageBox
    {
        $this->language = $lang->value;
        return $this;
    }

    public function render() : MessageBoxPressedButton
    {
        $ffi = FFI::cdef(
            "int MessageBoxExW(void* hWnd, unsigned short* lpText, unsigned short* lpCaption, unsigned int uType, 
            unsigned short wLanguageId);",
            "user32.dll");

        $returnValue = $ffi->MessageBoxExW($this->windowOwner, $this->content, $this->title, $this->properties,
            $this->language);

        return MessageBoxPressedButton::from($returnValue);
    }
}

