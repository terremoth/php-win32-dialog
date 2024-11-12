<?php

namespace Win32Dialog;

enum MessageBoxIcon : int
{
    case WARNING = 0x00000030;
    case INFORMATION = 0x00000040;
    case QUESTION = 0x00000020;
    case ERROR = 0x00000010;
}
