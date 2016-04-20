// This file is part of Indian Language Converter

// Indian Language Converter is free software; you can redistribute it
// and/or modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.

// Copyright (C) 2005, 2006 Vijay Lakshminarayanan <liyer.vijay@gmail.com>

// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of the
// License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
// General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
// 02110-1301, USA.

var vowels = "(A)|(E)|(H)|(I)|(M)|(O)|(Q)|(U)|(a((a)|(e)|(i)|(u))?)|(e(e)?)|(i)|(o((a)|(o))?)|(q)|(u)"
var consonants = "(B(h)?)|(c)|(C)|(D(h)?)|(J(h)?)|K|(L)|(N)|S|(T(h)?)|(b(h)?)|(ch)|(d(h)?)|(f)|(g)|(G)|(h)|(j(h)?)|k|(l)|(m)|(n((G)|(Y))?)|p|P|(r(R)?)|(s(h)?)|(t(h)?)|(v)|(w)|(y)"
var letter_codes = {
"~a" : "&#3205;",
"~aa" : "&#3206;",
"~A" : "&#3206;",
"~i" : "&#3207;",
"~ee" : "&#3208;",
"~I" : "&#3208;",
"~u" : "&#3209;",
"~oo" : "&#3210;",
"~U" : "&#3210;",
"~e" : "&#3214;",
"~ae" : "&#3215;",
"~E" : "&#3215;",
"~ai" : "&#3216;",
"~o" : "&#3218;",
"~oa" : "&#3219;",
"~O" : "&#3219;",
"~au" : "&#3220;",
"~q" : "&#3211;",
"~Q" : "&#3296;",
"a" : "",
"aa" : "&#3262;",
"A" : "&#3262;",
"i" : "&#3263;",
"ee" : "&#3264;",
"I" : "&#3264;",
"u" : "&#3265;",
"oo" : "&#3266;",
"U" : "&#3266;",
"e" : "&#3270;",
"ae" : "&#3271;",
"E" : "&#3271;",
"ai" : "&#3272;",
"o" : "&#3274;",
"oa" : "&#3275;",
"O" : "&#3275;",
"au" : "&#3276;",
"q" : "&#3267;",
"Q" : "&#3268;",
"k" : "&#3221;",
"K" : "&#3222;",
"g" : "&#3223;",
"G" : "&#3224;",
"nG" : "&#3225;",
"c" : "&#3226;",
"C" : "&#3227;",
"j" : "&#3228;",
"jh" : "&#3229;",
"J" : "&#3229;",
"Jh" : "&#3229;",
"nY" : "&#3230;",
"T" : "&#3231;",
"Th" : "&#3232;",
"D" : "&#3233;",
"Dh" : "&#3234;",
"N" : "&#3235;",
"t" : "&#3236;",
"th" : "&#3237;",
"d" : "&#3238;",
"dh" : "&#3239;",
"n" : "&#3240;",
"p" : "&#3242;",
"P" : "&#3243;",
"b" : "&#3244;",
"B" : "&#3245;",
"bh" : "&#3245;",
"Bh" : "&#3245;",
"m" : "&#3246;",
"y" : "&#3247;",
"r" : "&#3248;",
"rR" : "&#3249;",
"l" : "&#3250;",
"L" : "&#3251;",
"v" : "&#3253;",
"w" : "&#3253;",
"sh" : "&#3254;",
"S" : "&#3255;",
"s" : "&#3256;",
"h" : "&#3257;",
"f" : "&#3294;",
"M" : "&#3202;",
"H" : "&#3203;",
"~M" : "&#3202;",
"~H" : "&#3203;",
"*" : "&#3277;",
"x" : "&#8204;"
}
