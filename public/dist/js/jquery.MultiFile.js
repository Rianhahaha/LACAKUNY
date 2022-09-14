/* jquery-multifile v2.2.2 @ 2020-04-16 06:05:29 */
window.jQuery &&
  (function (d) {
    "use strict";
    function g(e) {
      return 1048576 < e ? (e / 1048576).toFixed(1) + "Mb" : 1024 == e ? "1Mb" : (e / 1024).toFixed(1) + "Kb";
    }
    function h(e) {
      return (e.files && e.files.length ? e.files : null) || [{ name: e.value, size: 0, type: ((e.value || "").match(/[^\.]+$/i) || [""])[0] }];
    }
    (d.fn.MultiFile = function (e) {
      if (0 == this.length) return this;
      if ("string" == typeof arguments[0]) {
        if (1 < this.length) {
          var i = arguments;
          return this.each(function () {
            d.fn.MultiFile.apply(d(this), i);
          });
        }
        return d.fn.MultiFile[arguments[0]].apply(this, d.makeArray(arguments).slice(1) || []);
      }
      "number" == typeof e && (e = { max: e }),
        (e = d.extend({}, d.fn.MultiFile.options, e || {})),
        d("form").not("MultiFile-intercepted").addClass("MultiFile-intercepted").submit(d.fn.MultiFile.disableEmpty),
        d.fn.MultiFile.options.autoIntercept && (d.fn.MultiFile.intercept(d.fn.MultiFile.options.autoIntercept), (d.fn.MultiFile.options.autoIntercept = null)),
        this.not(".MultiFile-applied")
          .addClass("MultiFile-applied")
          .each(function () {
            window.MultiFile = (window.MultiFile || 0) + 1;
            var i = window.MultiFile,
              f = { e: this, E: d(this), clone: d(this).clone() },
              p = d.extend({}, d.fn.MultiFile.options, e || {}, (d.metadata ? f.E.metadata() : d.meta ? f.E.data() : null) || {}, {});
            0 < p.max || (p.max = f.E.attr("maxlength")),
              0 < p.max || ((p.max = (String(f.e.className.match(/\b(max|limit)\-([0-9]+)\b/gi) || [""]).match(/[0-9]+/gi) || [""])[0]), 0 < p.max ? (p.max = String(p.max).match(/[0-9]+/gi)[0]) : (p.max = -1)),
              (p.max = new Number(p.max)),
              (p.accept = p.accept || f.E.attr("accept") || ""),
              p.accept || ((p.accept = f.e.className.match(/\b(accept\-[\w\|]+)\b/gi) || ""), (p.accept = new String(p.accept).replace(/^(accept|ext)\-/i, ""))),
              (p.maxsize = 0 < p.maxsize ? p.maxsize : f.E.data("maxsize") || 0),
              0 < p.maxsize ||
                ((p.maxsize = (String(f.e.className.match(/\b(maxsize|maxload|size)\-([0-9]+)\b/gi) || [""]).match(/[0-9]+/gi) || [""])[0]), 0 < p.maxsize ? (p.maxsize = String(p.maxsize).match(/[0-9]+/gi)[0]) : (p.maxsize = -1)),
              (p.maxfile = 0 < p.maxfile ? p.maxfile : f.E.data("maxfile") || 0),
              0 < p.maxfile || ((p.maxfile = (String(f.e.className.match(/\b(maxfile|filemax)\-([0-9]+)\b/gi) || [""]).match(/[0-9]+/gi) || [""])[0]), 0 < p.maxfile ? (p.maxfile = String(p.maxfile).match(/[0-9]+/gi)[0]) : (p.maxfile = -1)),
              1 < p.maxfile && (p.maxfile = 1024 * p.maxfile),
              1 < p.maxsize && (p.maxsize = 1024 * p.maxsize),
              !1 !== p.multiple && 1 < p.max && f.E.attr("multiple", "multiple").prop("multiple", !0),
              d.extend(f, p || {}),
              (f.STRING = d.extend({}, d.fn.MultiFile.options.STRING, f.STRING)),
              d.extend(f, {
                n: 0,
                slaves: [],
                files: [],
                instanceKey: f.e.id || "MultiFile" + String(i),
                generateID: function (e) {
                  return f.instanceKey + (0 < e ? "_F" + String(e) : "");
                },
                trigger: function (e, t, a, i) {
                  var l,
                    n = a[e] || a["on" + e];
                  if (n)
                    return (
                      (i = i || a.files || h(this)),
                      d.each(i, function (e, i) {
                        l = n.apply(a.wrapper, [t, i.name, a, i]);
                      }),
                      l
                    );
                },
              }),
              1 < String(f.accept).length && ((f.accept = f.accept.replace(/\W+/g, "|").replace(/^\W|\W$/g, "")), (f.rxAccept = new RegExp("\\.(" + (f.accept ? f.accept : "") + ")$", "gi"))),
              (f.wrapID = f.instanceKey),
              f.E.wrap('<div class="MultiFile-wrap" id="' + f.wrapID + '"></div>'),
              (f.wrapper = d("#" + f.wrapID)),
              (f.e.name = f.e.name || "file" + i + "[]"),
              f.list || (f.wrapper.append('<div class="MultiFile-list" id="' + f.wrapID + '_list"></div>'), (f.list = d("#" + f.wrapID + "_list"))),
              (f.list = d(f.list)),
              (f.addSlave = function (u, m) {
                var e;
                f.n++,
                  (u.MultiFile = f),
                  (u.id = u.name = ""),
                  (u.id = f.generateID(m)),
                  (u.name = String(
                    f.namePattern
                      .replace(/\$name/gi, d(f.clone).attr("name"))
                      .replace(/\$id/gi, d(f.clone).attr("id"))
                      .replace(/\$g/gi, i)
                      .replace(/\$i/gi, m)
                  )),
                  0 < f.max && f.files.length > f.max && (e = u.disabled = !0),
                  (f.current = u),
                  ((u = d(u)).val("").attr("value", "")[0].value = ""),
                  u.addClass("MultiFile-applied"),
                  u.change(function (e, i, t) {
                    d(this).blur();
                    var r = this,
                      a = f.files || [],
                      l = this.files || [{ name: this.value, size: 0, type: ((this.value || "").match(/[^\.]+$/i) || [""])[0] }],
                      n = [],
                      s = 0,
                      c = f.total_size || 0,
                      o = [];
                    d.each(l, function (e, i) {
                      n[n.length] = i;
                    }),
                      f.trigger("FileSelect", this, f, n),
                      d.each(l, function (e, i) {
                        function a(e) {
                          return e
                            .replace("$ext", String(l.match(/[^\.]+$/i) || ""))
                            .replace("$file", l.match(/[^\/\\]+$/gi))
                            .replace("$size", g(t) + " > " + g(f.maxfile));
                        }
                        var l = i.name.replace(/^C:\\fakepath\\/gi, ""),
                          t = i.size;
                        f.accept && l && !l.match(f.rxAccept) && ((o[o.length] = a(f.STRING.denied)), f.trigger("FileInvalid", this, f, [i])),
                          d(f.wrapper)
                            .find("input[type=file]")
                            .not(r)
                            .each(function () {
                              d.each(h(this), function (e, i) {
                                if (i.name) {
                                  var t = (i.name || "").replace(/^C:\\fakepath\\/gi, "");
                                  (l != t && l != t.substr(t.length - l.length)) || ((o[o.length] = a(f.STRING.duplicate)), f.trigger("FileDuplicate", r, f, [i]));
                                }
                              });
                            }),
                          0 < f.maxfile && 0 < t && t > f.maxfile && ((o[o.length] = a(f.STRING.toobig)), f.trigger("FileTooBig", this, f, [i]));
                        var n = f.trigger("FileValidate", this, f, [i]);
                        n && "" != n && (o[o.length] = a(n)), (s += i.size);
                      }),
                      (c += s),
                      (n.size = s),
                      (n.total = c),
                      (n.total_length = n.length + a.length),
                      0 < f.max && a.length + l.length > f.max && ((o[o.length] = f.STRING.toomany.replace("$max", f.max)), f.trigger("FileTooMany", this, f, n)),
                      0 < f.maxsize && c > f.maxsize && ((o[o.length] = f.STRING.toomuch.replace("$size", g(c) + " > " + g(f.maxsize))), f.trigger("FileTooMuch", this, f, n));
                    var p = d(f.clone).clone();
                    if ((p.addClass("MultiFile"), 0 < o.length)) return f.error(o.join("\n\n")), f.n--, f.addSlave(p[0], m), u.parent().prepend(p), u.remove(), !1;
                    (f.total_size = c),
                      ((l = a.concat(n)).size = c),
                      (l.size_label = g(c)),
                      (f.files = l),
                      d(this).css({ position: "absolute", top: "-3000px" }),
                      u.after(p),
                      f.addSlave(p[0], m + 1),
                      f.addToList(this, m, n),
                      f.trigger("afterFileSelect", this, f, n);
                  }),
                  d(u).data("MultiFile-wrap", f.wrapper),
                  d(f.wrapper).data("MultiFile", f),
                  e && d(u).attr("disabled", "disabled").prop("disabled", !0);
              }),
              (f.addToList = function (c, e, i) {
                f.trigger("FileAppend", c, f, i);
                var o = d("<span/>");
                d.each(i, function (e, t) {
                  var i = String(t.name || "").replace(/[&<>'"]/g, function (e) {
                      return "&#" + e.charCodeAt() + ";";
                    }),
                    a = f.STRING,
                    l = a.label || a.file || a.name,
                    n = a.title || a.tooltip || a.selected,
                    r = "image/" == t.type.substr(0, 6) ? '<img class="MultiFile-preview" style="' + f.previewCss + '"/>' : "",
                    s = d(
                      ('<span class="MultiFile-label" title="' + n + '"><span class="MultiFile-title">' + l + "</span>" + (f.preview || d(c).is(".with-preview") ? r : "") + "</span>")
                        .replace(/\$(file|name)/gi, (i.match(/[^\/\\]+$/gi) || [i])[0])
                        .replace(/\$(ext|extension|type)/gi, (i.match(/[^\.]+$/gi) || [""])[0])
                        .replace(/\$(size)/gi, g(t.size || 0))
                        .replace(/\$(preview)/gi, r)
                        .replace(/\$(i)/gi, e)
                    );
                  s.find("img.MultiFile-preview").each(function () {
                    var i = this,
                      e = new FileReader();
                    e.readAsDataURL(t),
                      (e.onload = function (e) {
                        i.src = e.target.result;
                      });
                  }),
                    0 < e && p.separator && o.append(p.separator),
                    o.append(s),
                    (i = String(t.name || "")),
                    (o[o.length] = ('<span class="MultiFile-title" title="' + f.STRING.selected + '">' + f.STRING.file + "</span>")
                      .replace(/\$(file|name)/gi, (i.match(/[^\/\\]+$/gi) || [i])[0])
                      .replace(/\$(ext|extension|type)/gi, (i.match(/[^\.]+$/gi) || [""])[0])
                      .replace(/\$(size)/gi, g(t.size || 0))
                      .replace(/\$(i)/gi, e));
                });
                var t = d('<div class="MultiFile-label"></div>'),
                  a = d('<a class="MultiFile-remove" href="#' + f.wrapID + '">' + f.STRING.remove + "</a>").click(function () {
                    var e = h(c);
                    f.trigger("FileRemove", c, f, e), f.n--, (f.current.disabled = !1), d(c).remove(), d(this).parent().remove(), d(f.current).css({ position: "", top: "" }), (d(f.current).reset().val("").attr("value", "")[0].value = "");
                    var t = [],
                      a = 0;
                    return (
                      d(f.wrapper)
                        .find("input[type=file]")
                        .each(function () {
                          d.each(h(this), function (e, i) {
                            i.name && ((t[t.length] = i), (a += i.size));
                          });
                        }),
                      (f.files = t),
                      (f.total_size = a),
                      (f.size_label = g(a)),
                      d(f.wrapper).data("MultiFile", f),
                      f.trigger("afterFileRemove", c, f, e),
                      f.trigger("FileChange", f.current, f, t),
                      !1
                    );
                  });
                f.list.append(t.append(a, " ", o)), f.trigger("afterFileAppend", c, f, i), f.trigger("FileChange", c, f, f.files);
              }),
              f.MultiFile || f.addSlave(f.e, 0),
              f.n++;
          });
    }),
      d.extend(d.fn.MultiFile, {
        data: function () {
          var e = d(this),
            i = e.is(".MultiFile-wrap") ? e : e.data("MultiFile-wrap");
          if (!i || !i.length) return !console.error("Could not find MultiFile control wrapper");
          var t = i.data("MultiFile");
          return t ? t || {} : !console.error("Could not find MultiFile data in wrapper");
        },
        reset: function () {
          var e = this.MultiFile("data");
          return e && d(e.list).find("a.MultiFile-remove").click(), d(this);
        },
        files: function () {
          var e = this.MultiFile("data");
          return e ? e.files || [] : !console.log("MultiFile plugin not initialized");
        },
        size: function () {
          var e = this.MultiFile("data");
          return e ? e.total_size || 0 : !console.log("MultiFile plugin not initialized");
        },
        count: function () {
          var e = this.MultiFile("data");
          return e ? (e.files && e.files.length) || 0 : !console.log("MultiFile plugin not initialized");
        },
        disableEmpty: function (e) {
          e = ("string" == typeof e ? e : "") || "mfD";
          var i = [];
          return (
            d("input:file.MultiFile").each(function () {
              "" == d(this).val() && (i[i.length] = this);
            }),
            window.clearTimeout(d.fn.MultiFile.reEnableTimeout),
            (d.fn.MultiFile.reEnableTimeout = window.setTimeout(d.fn.MultiFile.reEnableEmpty, 500)),
            d(i)
              .each(function () {
                this.disabled = !0;
              })
              .addClass(e)
          );
        },
        reEnableEmpty: function (e) {
          return d("input:file." + (e = ("string" == typeof e ? e : "") || "mfD"))
            .removeClass(e)
            .each(function () {
              this.disabled = !1;
            });
        },
        intercepted: {},
        intercept: function (e, i, t) {
          var a, l;
          if (((t = t || []).constructor.toString().indexOf("Array") < 0 && (t = [t]), "function" == typeof e))
            return (
              d.fn.MultiFile.disableEmpty(),
              (l = e.apply(i || window, t)),
              setTimeout(function () {
                d.fn.MultiFile.reEnableEmpty();
              }, 1e3),
              l
            );
          e.constructor.toString().indexOf("Array") < 0 && (e = [e]);
          for (var n = 0; n < e.length; n++)
            (a = e[n] + "") &&
              (function (e) {
                (d.fn.MultiFile.intercepted[e] = d.fn[e] || function () {}),
                  (d.fn[e] = function () {
                    return (
                      d.fn.MultiFile.disableEmpty(),
                      (l = d.fn.MultiFile.intercepted[e].apply(this, arguments)),
                      setTimeout(function () {
                        d.fn.MultiFile.reEnableEmpty();
                      }, 1e3),
                      l
                    );
                  });
              })(a);
        },
      }),
      (d.fn.MultiFile.options = {
        accept: "",
        max: -1,
        maxfile: -1,
        maxsize: -1,
        namePattern: "$name",
        preview: !1,
        previewCss: "max-height:100px; max-width:100px;",
        separator: ", ",
        STRING: {
          remove: "x",
          denied: "You cannot select a $ext file.\nTry again...",
          file: "$file",
          selected: "File selected: $file",
          duplicate: "This file has already been selected:\n$file",
          toomuch: "The files selected exceed the maximum size permited ($size)",
          toomany: "Too many files selected (max: $max)",
          toobig: "$file is too big (max $size)",
        },
        autoIntercept: ["submit", "ajaxSubmit", "ajaxForm", "validate", "valid"],
        error: function (e) {
          "undefined" != typeof console && console.log(e), alert(e);
        },
      }),
      (d.fn.reset =
        d.fn.reset ||
        function () {
          return this.each(function () {
            try {
              this.reset();
            } catch (e) {}
          });
        }),
      d(function () {
        d("input[type=file].multi").MultiFile();
      });
  })(jQuery);
