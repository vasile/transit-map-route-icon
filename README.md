## About

This PHP script generates route icons used by vehicles(markers) from [Transit Map](https://github.com/vasile/transit-map) web application that animates vehicles on a map based on timetables and network.

The script was tested on OSX machines with PHP 5.x and GD2 library

## Install

- clone / download the copy of the repo on your machine

## How to use

- CLI - [result](http://screencast.com/t/bbaquzcRj2)
    
        $ cd /path/to/repo
    
        # Generate a 20x20 px icon with a red circle(ellipse) having "23" written inside
        # The icon is saved inside /path/to/repo/tmp
        $ php route_icon.php bg=FF0000 fg=FFFFFF t=23
        
        # Generate same icon but 100x100px size
        $ php route_icon.php w=100 bg=FF0000 fg=FFFFFF t=23
        
- in browser navigate to [route_icon.php?w=100&bg=FF0000&fg=FFFFFF&t=23](http://localhost/transit-map-route-icon/route_icon.php?w=100&bg=FF0000&fg=FFFFFF&t=23)


## License

**Copyright (c) 2014 Vasile Coțovanu** - http://www.vasile.ch
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the **following conditions:**
 
* **The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.**
 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
