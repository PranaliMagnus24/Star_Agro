/**
 * Template Name: NiceAdmin
 * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
 * Updated: Apr 20 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

// Category Selection
$(document).ready(function () {
    $("#category_id").change(function () {
        var categoryId = $(this).val();
        $("#subcategory_id")
            .empty()
            .append('<option value="">--Select Sub Category--</option>');
        $("#subsubcategory_id")
            .empty()
            .append('<option value="">--Select Sub Sub Category--</option>');

        if (categoryId) {
            $.ajax({
                url: "/get-subcategories/" + categoryId,
                type: "GET",
                success: function (data) {
                    $.each(data, function (key, value) {
                        $("#subcategory_id").append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.category_name +
                                "</option>"
                        );
                    });
                },
            });
        }
    });

    $("#subcategory_id").change(function () {
        var subcategoryId = $(this).val();
        $("#crop_id")
            .empty()
            .append('<option value="">--Select Crop Name--</option>');

        if (subcategoryId) {
            $.ajax({
                url: "/get-crops/" + subcategoryId,
                type: "GET",
                success: function (data) {
                    $.each(data, function (key, value) {
                        $("#crop_id").append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.category_name +
                                "</option>"
                        );
                    });
                },
            });
        }
    });
});

(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Search bar toggle
     */
    if (select(".search-bar-toggle")) {
        on("click", ".search-bar-toggle", function (e) {
            select(".search-bar").classList.toggle("search-bar-show");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select(".quill-editor-default")) {
        new Quill(".quill-editor-default", {
            theme: "snow",
        });
    }

    if (select(".quill-editor-bubble")) {
        new Quill(".quill-editor-bubble", {
            theme: "bubble",
        });
    }

    if (select(".quill-editor-full")) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [
                        {
                            font: [],
                        },
                        {
                            size: [],
                        },
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ],
                    [
                        {
                            script: "super",
                        },
                        {
                            script: "sub",
                        },
                    ],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ],
                    [
                        "direction",
                        {
                            align: [],
                        },
                    ],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            theme: "snow",
        });
    }

    /**
     * Initiate TinyMCE Editor
     */

    const useDarkMode = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;

    tinymce.init({
        selector: "textarea.tinymce-editor",
        plugins:
            "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion",
        editimage_cors_hosts: ["picsum.photos"],
        menubar: "file edit view insert format tools table help",
        toolbar:
            "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        link_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_class_list: [
            {
                title: "None",
                value: "",
            },
            {
                title: "Some class",
                value: "class-name",
            },
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === "file") {
                callback("https://www.google.com/logos/google.jpg", {
                    text: "My text",
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === "image") {
                callback("https://www.google.com/logos/google.jpg", {
                    alt: "My alt text",
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === "media") {
                callback("movie.mp4", {
                    source2: "alt.ogg",
                    poster: "https://www.google.com/logos/google.jpg",
                });
            }
        },
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar:
            "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
        noneditable_class: "mceNonEditable",
        toolbar_mode: "sliding",
        contextmenu: "link image table",
        skin: useDarkMode ? "oxide-dark" : "oxide",
        content_css: useDarkMode ? "dark" : "default",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    /**
     * Initiate Datatables
     */
    const datatables = select(".datatable", true);
    datatables.forEach((datatable) => {
        new simpleDatatables.DataTable(datatable, {
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [
                {
                    select: 2,
                    sortSequence: ["desc", "asc"],
                },
                {
                    select: 3,
                    sortSequence: ["desc"],
                },
                {
                    select: 4,
                    cellClass: "green",
                    headerClass: "red",
                },
            ],
        });
    });

    /**
     * Autoresize echart charts
     */
    const mainContainer = select("#main");
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select(".echart", true).forEach((getEchart) => {
                    echarts.getInstanceByDom(getEchart).resize();
                });
            }).observe(mainContainer);
        }, 200);
    }

    document.getElementById("zip_code").addEventListener("blur", function () {
        var pincode = this.value.trim();
        if (pincode) {
            fetch(`/get-taluka-town/${pincode}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.taluka && data.officename) {
                        document.getElementById("taluka").value = data.taluka;
                        document.getElementById("town").value = `${
                            data.officename
                        }, ${data.RelatedSuboffice || "Unknown"}`;
                    } else {
                        document.getElementById("taluka").value = "Unknown";
                        document.getElementById("town").value = "Unknown";
                    }
                })
                .catch((error) => {
                    console.error("Error fetching taluka and town:", error);
                    alert(
                        "Failed to fetch taluka and town. Please try again later."
                    );
                });
        }
    });

    /////member active tab
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get("tab") || localStorage.getItem("activeTab");

        if (tab) {
            const tabButton = document.querySelector(
                `button[data-bs-target="#${tab}"]`
            );
            const tabContent = document.querySelector(`#${tab}`);

            if (tabButton && tabContent) {
                tabButton.classList.add("active");
                tabContent.classList.add("show", "active");
            }
        }

        const tabButtons = document.querySelectorAll(".nav-link");
        tabButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const targetTab =
                    this.getAttribute("data-bs-target").substring(1);
                localStorage.setItem("activeTab", targetTab);
            });
        });
    });
});
