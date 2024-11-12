<?php

namespace Win32Dialog;

enum MessageBoxModality : int
{
    case APPLICATION = 0x00000000;
    case SYSTEM = 0x00001000;
    case TASK = 0x00002000;
}
