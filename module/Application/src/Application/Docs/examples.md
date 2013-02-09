# All markdown examples see [daring firebull markdown syntax](http://daringfireball.net/projects/markdown/syntax "title")

# Block elements
___
## Paragraphs
___
First paragraph first line,
First paragraph first line [2 spaces = hard-break]->  
First paragraph second line  

Second paragraph first line  
Second paragraph second line

## Headings
___
### Setext headings
This is a setext h1
============
This is a setext h2

### axt headings
# This is a axt header 1
## This is a axt header 2
###### This is a axt header 5

## Blockquotes
___
> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
> consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
> Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
> 
> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
> id sem consectetuer libero luctus adipiscing.

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.

## Lists
___
* starts
* starts

+ pluses
+ pluses

- dashes
- dashes


1. Number
2. Number
3. Number


* Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
  Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
  viverra nec, fringilla in, laoreet vitae, risus.
* Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
  Suspendisse id sem consectetuer libero luctus adipiscing.

## Code blocks
___
This is a normal paragraph:

    This is a code block.

## Horizontal rules
___
* * *

***

*****

- - -

---------------------------------------

# Span elements
___

## Links
___
This is [an example](http://example.com/ "Title") inline link.

[This link](http://example.net/) has no title attribute.

This is [an example][id] reference-style link.
[id]: http://example.com/  "Optional Title Here"

## Emphasis
___
*single asterisks*

_single underscores_

**double asterisks**

__double underscores__

un*frigging*believable
## Code
___
Use the `printf()` function.

``There is a literal backtick (`) here.``

## Images
___
![Alt text](http://pilotmoon.com/popclip/extensions/icon/md.png "Optional title")

Using a image tag `<img width=100 height=100 />`

<img src="http://pilotmoon.com/popclip/extensions/icon/md.png" width=100 height=100 />

# Misc
___

## Automatic link
___
<http://example.com/>

<address@example.com>

## Backslash Escapes
___
\*literal asterisks\*  
\\   backslash  
\`   backtick  
\*   asterisk  
\_   underscore  
\{}  curly braces  
\[]  square brackets  
\()  parentheses  
\#   hash mark  
\+   plus sign  
\-   minus sign (hyphen)  
\.   dot  
\!   exclamation mark  