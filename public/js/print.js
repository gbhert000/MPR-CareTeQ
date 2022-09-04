// /* @license
//  * jQuery.print, version 1.6.2
//  * Licence: CC-By (http://creativecommons.org/licenses/by/3.0/)
//  *--------------------------------------------------------------------------*/
// (function ($) {
//     "use strict";
//     // A nice closure for our definitions

//     function jQueryCloneWithSelectAndTextAreaValues(elmToClone, withDataAndEvents, deepWithDataAndEvents) {
//         // Replacement jQuery clone that also clones the values in selects and textareas as jQuery doesn't for performance reasons - https://stackoverflow.com/questions/742810/clone-isnt-cloning-select-values
//         // Based on https://github.com/spencertipping/jquery.fix.clone
//         var $elmToClone = $(elmToClone),
//             $result           = $elmToClone.clone(withDataAndEvents, deepWithDataAndEvents),
//             $myTextareas     = $elmToClone.find('textarea').add($elmToClone.filter('textarea')),
//             $resultTextareas = $result.find('textarea').add($result.filter('textarea')),
//             $mySelects       = $elmToClone.find('select').add($elmToClone.filter('select')),
//             $resultSelects   = $result.find('select').add($result.filter('select')),
//             $myCanvas       = $elmToClone.find('canvas').add($elmToClone.filter('canvas')),
//             $resultCanvas   = $result.find('canvas').add($result.filter('canvas')),
//             i, l, j, m, myCanvasContext;

//         for (i = 0, l = $myTextareas.length; i < l; ++i) {
//             $($resultTextareas[i]).val($($myTextareas[i]).val());
//         }
//         for (i = 0, l = $mySelects.length;   i < l; ++i) {
//             for (j = 0, m = $mySelects[i].options.length; j < m; ++j) {
//                 if ($mySelects[i].options[j].selected === true) {
//                     $resultSelects[i].options[j].selected = true;
//                 }
//             }
//         }
//         for (i = 0, l = $myCanvas.length; i < l; ++i) {
//             // https://stackoverflow.com/a/41242597
//             myCanvasContext = $myCanvas[i].getContext('2d');
//             if(myCanvasContext) {
//                 $resultCanvas[i].getContext('2d').drawImage($myCanvas[i], 0,0);
//                 $($resultCanvas[i]).attr("data-jquery-print", myCanvasContext.canvas.toDataURL());
//             }
//         }
//         return $result;
//     }

//     function getjQueryObject(string) {
//         // Make string a vaild jQuery thing
//         var jqObj = $("");
//         try {
//             jqObj = jQueryCloneWithSelectAndTextAreaValues(string);
//         } catch (e) {
//             jqObj = $("<span />")
//                 .html(string);
//         }
//         return jqObj;
//     }

//     function printFrame(frameWindow, content, options) {
//         // Print the selected window/iframe
//         var def = $.Deferred();
//         try {
//             frameWindow = frameWindow.contentWindow || frameWindow.contentDocument || frameWindow;
//             try {
//                 frameWindow.resizeTo(window.innerWidth, window.innerHeight);
//             } catch (err) {
//                 console.warn(err);
//             }
//             var wdoc = frameWindow.document || frameWindow.contentDocument || frameWindow;
//             if(options.doctype) {
//                 wdoc.write(options.doctype);
//             }
//             wdoc.write(content);
//             try {
//                 var canvas = wdoc.querySelectorAll('canvas');
//                 for(var i = 0; i < canvas.length; i++) {
//                     var ctx = canvas[i].getContext("2d");
//                     var image = new Image();
//                     image.onload = function() {
//                         ctx.drawImage(image, 0, 0);
//                     };
//                     image.src = canvas[i].getAttribute("data-jquery-print");
//                 }
//             } catch (err) {
//                 console.warn(err);
//             }
//             wdoc.close();
//             var printed = false,
//                 callPrint = function () {
//                     if(printed) {
//                         return;
//                     }
//                     // Fix for IE : Allow it to render the iframe
//                     frameWindow.focus();
//                     try {
//                         // Fix for IE11 - printng the whole page instead of the iframe content
//                         if (!frameWindow.document.execCommand('print', false, null)) {
//                             // document.execCommand returns false if it failed -http://stackoverflow.com/a/21336448/937891
//                             frameWindow.print();
//                         }
//                         // focus body as it is losing focus in iPad and content not getting printed
//                         $('body').focus();
//                     } catch (e) {
//                         frameWindow.print();
//                     }
//                     frameWindow.close();
//                     printed = true;
//                     def.resolve();
//                 };
//             // Print once the frame window loads - seems to work for the new-window option but unreliable for the iframe
//             $(frameWindow).on("load", callPrint);
//             // Fallback to printing directly if the frame doesn't fire the load event for whatever reason
//             setTimeout(callPrint, options.timeout);
//         } catch (err) {
//             def.reject(err);
//         }
//         return def;
//     }

//     function printContentInIFrame(content, options) {
//         var $iframe = $(options.iframe + "");
//         var iframeCount = $iframe.length;
//         if (iframeCount === 0) {
//             // Create a new iFrame if none is given
//             $iframe = $('<iframe height="0" width="0" border="0" wmode="Opaque"/>')
//                 .prependTo('body')
//                 .css({
//                     "position": "absolute",
//                     "top": -999,
//                     "left": -999
//                 });
//         }
//         var frameWindow = $iframe.get(0);
//         return printFrame(frameWindow, content, options)
//             .done(function () {
//                 // Success
//                 setTimeout(function () {
//                     // Wait for IE
//                     if (iframeCount === 0) {
//                         // Destroy the iframe if created here
//                         $iframe.remove();
//                     }
//                 }, 1000);
//             })
//             .fail(function (err) {
//                 // Use the pop-up method if iframe fails for some reason
//                 console.error("Failed to print from iframe", err);
//                 printContentInNewWindow(content, options);
//             })
//             .always(function () {
//                 try {
//                     options.deferred.resolve();
//                 } catch (err) {
//                     console.warn('Error notifying deferred', err);
//                 }
//             });
//     }

//     function printContentInNewWindow(content, options) {
//         // Open a new window and print selected content
//         var frameWindow = window.open();
//         return printFrame(frameWindow, content, options)
//             .always(function () {
//                 try {
//                     options.deferred.resolve();
//                 } catch (err) {
//                     console.warn('Error notifying deferred', err);
//                 }
//             });
//     }

//     function isNode(o) {
//         /* http://stackoverflow.com/a/384380/937891 */
//         return !!(typeof Node === "object" ? o instanceof Node : o && typeof o === "object" && typeof o.nodeType === "number" && typeof o.nodeName === "string");
//     }
//     $.print = $.fn.print = function () {
//         // Print a given set of elements
//         var options, $this, self = this;
//         // console.log("Printing", this, arguments);
//         if (self instanceof $) {
//             // Get the node if it is a jQuery object
//             self = self.get(0);
//         }
//         if (isNode(self)) {
//             // If `this` is a HTML element, i.e. for
//             // $(selector).print()
//             $this = $(self);
//             if (arguments.length > 0) {
//                 options = arguments[0];
//             }
//         } else {
//             if (arguments.length > 0) {
//                 // $.print(selector,options)
//                 $this = $(arguments[0]);
//                 if (isNode($this[0])) {
//                     if (arguments.length > 1) {
//                         options = arguments[1];
//                     }
//                 } else {
//                     // $.print(options)
//                     options = arguments[0];
//                     $this = $("html");
//                 }
//             } else {
//                 // $.print()
//                 $this = $("html");
//             }
//         }
//         // Default options
//         var defaults = {
//             globalStyles: true,
//             mediaPrint: false,
//             stylesheet: null,
//             noPrintSelector: ".no-print",
//             iframe: true,
//             append: null,
//             prepend: null,
//             manuallyCopyFormValues: true,
//             deferred: $.Deferred(),
//             timeout: 750,
//             title: null,
//             doctype: '<!doctype html>'
//         };
//         // Merge with user-options
//         options = $.extend({}, defaults, (options || {}));
//         var $styles = $("");
//         if (options.globalStyles) {
//             // Apply the stlyes from the current sheet to the printed page
//             $styles = $("style, link, meta, base, title");
//         } else if (options.mediaPrint) {
//             // Apply the media-print stylesheet
//             $styles = $("link[media=print]");
//         }
//         if (options.stylesheet) {
//             // Add a custom stylesheet(s) if given
//             if (!(($.isArray ? $.isArray : Array.isArray)(options.stylesheet))) {
//                 options.stylesheet = [options.stylesheet]
//             }
//             for(var i = 0; i < options.stylesheet.length; i++) {
//                 $styles = $.merge($styles, $('<link rel="stylesheet" href="' + options.stylesheet[i] + '">'));
//             }
//         }
//         // Create a copy of the element to print
//         var copy = jQueryCloneWithSelectAndTextAreaValues($this, true, true);
//         // Wrap it in a span to get the HTML markup string
//         copy = $("<span/>")
//             .append(copy);
//         // Remove unwanted elements
//         copy.find(options.noPrintSelector)
//             .remove();
//         // Add in the styles
//         copy.append(jQueryCloneWithSelectAndTextAreaValues($styles));
//         // Update title
//         if (options.title) {
//             var title = $("title", copy);
//             if (title.length === 0) {
//                 title = $("<title />");
//                 copy.append(title);
//             }
//             title.text(options.title);
//         }
//         // Appedned content
//         copy.append(getjQueryObject(options.append));
//         // Prepended content
//         copy.prepend(getjQueryObject(options.prepend));
//         if (options.manuallyCopyFormValues) {
//             // Manually copy form values into the HTML for printing user-modified input fields
//             // http://stackoverflow.com/a/26707753
//             copy.find("input")
//                 .each(function () {
//                     var $field = $(this);
//                     if ($field.is("[type='radio']") || $field.is("[type='checkbox']")) {
//                         if ($field.prop("checked")) {
//                             $field.attr("checked", "checked");
//                         }
//                     } else {
//                         $field.attr("value", $field.val());
//                     }
//                 });
//             copy.find("select").each(function () {
//                 var $field = $(this);
//                 $field.find(":selected").attr("selected", "selected");
//             });
//             copy.find("textarea").each(function () {
//                 // Fix for https://github.com/DoersGuild/jQuery.print/issues/18#issuecomment-96451589
//                 var $field = $(this);
//                 $field.text($field.val());
//             });
//         }
//         // Get the HTML markup string
//         var content = copy.html();
//         // Notify with generated markup & cloned elements - useful for logging, etc
//         try {
//             options.deferred.notify('generated_markup', content, copy);
//         } catch (err) {
//             console.warn('Error notifying deferred', err);
//         }
//         // Destroy the copy
//         copy.remove();
//         if (options.iframe) {
//             // Use an iframe for printing
//             try {
//                 printContentInIFrame(content, options);
//             } catch (e) {
//                 // Use the pop-up method if iframe fails for some reason
//                 console.error("Failed to print from iframe", e.stack, e.message);
//                 printContentInNewWindow(content, options);
//             }
//         } else {
//             // Use a new window for printing
//             printContentInNewWindow(content, options);
//         }
//         return this;
//     };
// })(jQuery);
/*
 * printThis v2.0.0
 * @desc Printing plug-in for jQuery
 * @author Jason Day
 * @author Samuel Rouse
 *
 * Resources (based on):
 * - jPrintArea: http://plugins.jquery.com/project/jPrintArea
 * - jqPrint: https://github.com/permanenttourist/jquery.jqprint
 * - Ben Nadal: http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm
 *
 * Licensed under the MIT licence:
 *              http://www.opensource.org/licenses/mit-license.php
 *
 * (c) Jason Day 2015-2022
 *
 * Usage:
 *
 *  $("#mySelector").printThis({
 *      debug: false,                   // show the iframe for debugging
 *      importCSS: true,                // import parent page css
 *      importStyle: true,              // import style tags
 *      printContainer: true,           // grab outer container as well as the contents of the selector
 *      loadCSS: "path/to/my.css",      // path to additional css file - use an array [] for multiple
 *      pageTitle: "",                  // add title to print page
 *      removeInline: false,            // remove all inline styles from print elements
 *      removeInlineSelector: "body *", // custom selectors to filter inline styles. removeInline must be true
 *      printDelay: 1000,               // variable print delay
 *      header: null,                   // prefix to html
 *      footer: null,                   // postfix to html
 *      base: false,                    // preserve the BASE tag, or accept a string for the URL
 *      formValues: true,               // preserve input/form values
 *      canvas: true,                   // copy canvas elements
 *      doctypeString: '...',           // enter a different doctype for older markup
 *      removeScripts: false,           // remove script tags from print content
 *      copyTagClasses: true            // copy classes from the html & body tag
 *      copyTagStyles: true,            // copy styles from html & body tag (for CSS Variables)
 *      beforePrintEvent: null,         // callback function for printEvent in iframe
 *      beforePrint: null,              // function called before iframe is filled
 *      afterPrint: null                // function called before iframe is removed
 *  });
 *
 * Notes:
 *  - the loadCSS will load additional CSS (with or without @media print) into the iframe, adjusting layout
 */
;
(function($) {

    function appendContent($el, content) {
        if (!content) return;

        // Simple test for a jQuery element
        $el.append(content.jquery ? content.clone() : content);
    }

    function appendBody($body, $element, opt) {
        // Clone for safety and convenience
        // Calls clone(withDataAndEvents = true) to copy form values.
        var $content = $element.clone(opt.formValues);

        if (opt.formValues) {
            // Copy original select and textarea values to their cloned counterpart
            // Makes up for inability to clone select and textarea values with clone(true)
            copyValues($element, $content, 'select, textarea');
        }

        if (opt.removeScripts) {
            $content.find('script').remove();
        }

        if (opt.printContainer) {
            // grab $.selector as container
            $content.appendTo($body);
        } else {
            // otherwise just print interior elements of container
            $content.each(function() {
                $(this).children().appendTo($body)
            });
        }
    }

    // Copies values from origin to clone for passed in elementSelector
    function copyValues(origin, clone, elementSelector) {
        var $originalElements = origin.find(elementSelector);

        clone.find(elementSelector).each(function(index, item) {
            $(item).val($originalElements.eq(index).val());
        });
    }

    var opt;
    $.fn.printThis = function(options) {
        opt = $.extend({}, $.fn.printThis.defaults, options);
        var $element = this instanceof jQuery ? this : $(this);

        var strFrameName = "printThis-" + (new Date()).getTime();

        if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
            // Ugly IE hacks due to IE not inheriting document.domain from parent
            // checks if document.domain is set by comparing the host name against document.domain
            var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
            var printI = document.createElement('iframe');
            printI.name = "printIframe";
            printI.id = strFrameName;
            printI.className = "MSIE";
            document.body.appendChild(printI);
            printI.src = iframeSrc;

        } else {
            // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
            var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
            $frame.appendTo("body");
        }

        var $iframe = $("#" + strFrameName);

        // show frame if in debug mode
        if (!opt.debug) $iframe.css({
            position: "absolute",
            width: "0px",
            height: "0px",
            left: "-600px",
            top: "-600px"
        });

        // before print callback
        if (typeof opt.beforePrint === "function") {
            opt.beforePrint();
        }

        // $iframe.ready() and $iframe.load were inconsistent between browsers
        setTimeout(function() {

            // Add doctype to fix the style difference between printing and render
            function setDocType($iframe, doctype){
                var win, doc;
                win = $iframe.get(0);
                win = win.contentWindow || win.contentDocument || win;
                doc = win.document || win.contentDocument || win;
                doc.open();
                doc.write(doctype);
                doc.close();
            }

            if (opt.doctypeString){
                setDocType($iframe, opt.doctypeString);
            }

            var $doc = $iframe.contents(),
                $head = $doc.find("head"),
                $body = $doc.find("body"),
                $base = $('base'),
                baseURL;

            // add base tag to ensure elements use the parent domain
            if (opt.base === true && $base.length > 0) {
                // take the base tag from the original page
                baseURL = $base.attr('href');
            } else if (typeof opt.base === 'string') {
                // An exact base string is provided
                baseURL = opt.base;
            } else {
                // Use the page URL as the base
                baseURL = document.location.protocol + '//' + document.location.host;
            }

            $head.append('<base href="' + baseURL + '">');

            // import page stylesheets
            if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
                var href = $(this).attr("href");
                if (href) {
                    var media = $(this).attr("media") || "all";
                    $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                }
            });

            // import style tags
            if (opt.importStyle) $("style").each(function() {
                $head.append(this.outerHTML);
            });

            // add title of the page
            if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

            // import additional stylesheet(s)
            if (opt.loadCSS) {
                if ($.isArray(opt.loadCSS)) {
                    jQuery.each(opt.loadCSS, function(index, value) {
                        $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                    });
                } else {
                    $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
                }
            }

            var pageHtml = $('html')[0];

            // CSS VAR in html tag when dynamic apply e.g.  document.documentElement.style.setProperty("--foo", bar);
            $doc.find('html').prop('style', pageHtml.style.cssText);

            // copy 'root' tag classes
            var tag = opt.copyTagClasses;
            if (tag) {
                tag = tag === true ? 'bh' : tag;
                if (tag.indexOf('b') !== -1) {
                    $body.addClass($('body')[0].className);
                }
                if (tag.indexOf('h') !== -1) {
                    $doc.find('html').addClass(pageHtml.className);
                }
            }

            // copy ':root' tag classes
            tag = opt.copyTagStyles;
            if (tag) {
                tag = tag === true ? 'bh' : tag;
                if (tag.indexOf('b') !== -1) {
                    $body.attr('style', $('body')[0].style.cssText);
                }
                if (tag.indexOf('h') !== -1) {
                    $doc.find('html').attr('style', pageHtml.style.cssText);
                }
            }

            // print header
            appendContent($body, opt.header);

            if (opt.canvas) {
                // add canvas data-ids for easy access after cloning.
                var canvasId = 0;
                // .addBack('canvas') adds the top-level element if it is a canvas.
                $element.find('canvas').addBack('canvas').each(function(){
                    $(this).attr('data-printthis', canvasId++);
                });
            }

            appendBody($body, $element, opt);

            if (opt.canvas) {
                // Re-draw new canvases by referencing the originals
                $body.find('canvas').each(function(){
                    var cid = $(this).data('printthis'),
                        $src = $('[data-printthis="' + cid + '"]');

                    this.getContext('2d').drawImage($src[0], 0, 0);

                    // Remove the markup from the original
                    if ($.isFunction($.fn.removeAttr)) {
                        $src.removeAttr('data-printthis');
                    } else {
                        $.each($src, function(i, el) {
                            el.removeAttribute('data-printthis');
                        });
                    }
                });
            }

            // remove inline styles
            if (opt.removeInline) {
                // Ensure there is a selector, even if it's been mistakenly removed
                var selector = opt.removeInlineSelector || '*';
                // $.removeAttr available jQuery 1.7+
                if ($.isFunction($.removeAttr)) {
                    $body.find(selector).removeAttr("style");
                } else {
                    $body.find(selector).attr("style", "");
                }
            }

            // print "footer"
            appendContent($body, opt.footer);

            // attach event handler function to beforePrint event
            function attachOnBeforePrintEvent($iframe, beforePrintHandler) {
                var win = $iframe.get(0);
                win = win.contentWindow || win.contentDocument || win;

                if (typeof beforePrintHandler === "function") {
                    if ('matchMedia' in win) {
                        win.matchMedia('print').addListener(function(mql) {
                            if(mql.matches)  beforePrintHandler();
                        });
                    } else {
                        win.onbeforeprint = beforePrintHandler;
                    }
                }
            }
            attachOnBeforePrintEvent($iframe, opt.beforePrintEvent);

            setTimeout(function() {
                if ($iframe.hasClass("MSIE")) {
                    // check if the iframe was created with the ugly hack
                    // and perform another ugly hack out of neccessity
                    window.frames["printIframe"].focus();
                    $head.append("<script>  window.print(); </s" + "cript>");
                } else {
                    // proper method
                    if (document.queryCommandSupported("print")) {
                        $iframe[0].contentWindow.document.execCommand("print", false, null);
                    } else {
                        $iframe[0].contentWindow.focus();
                        $iframe[0].contentWindow.print();
                    }
                }

                // remove iframe after print
                if (!opt.debug) {
                    setTimeout(function() {
                        $iframe.remove();

                    }, 1000);
                }

                // after print callback
                if (typeof opt.afterPrint === "function") {
                    opt.afterPrint();
                }

            }, opt.printDelay);

        }, 333);

    };

    // defaults
    $.fn.printThis.defaults = {
        debug: false,                       // show the iframe for debugging
        importCSS: true,                    // import parent page css
        importStyle: true,                  // import style tags
        printContainer: true,               // print outer container/$.selector
        loadCSS: "",                        // path to additional css file - use an array [] for multiple
        pageTitle: "",                      // add title to print page
        removeInline: false,                // remove inline styles from print elements
        removeInlineSelector: "*",          // custom selectors to filter inline styles. removeInline must be true
        printDelay: 1000,                   // variable print delay
        header: null,                       // prefix to html
        footer: null,                       // postfix to html
        base: false,                        // preserve the BASE tag or accept a string for the URL
        formValues: true,                   // preserve input/form values
        canvas: true,                       // copy canvas content
        doctypeString: '<!DOCTYPE html>',   // enter a different doctype for older markup
        removeScripts: false,               // remove script tags from print content
        copyTagClasses: true,               // copy classes from the html & body tag
        copyTagStyles: true,                // copy styles from html & body tag (for CSS Variables)
        beforePrintEvent: null,             // callback function for printEvent in iframe
        beforePrint: null,                  // function called before iframe is filled
        afterPrint: null                    // function called before iframe is removed
    };
})(jQuery);


