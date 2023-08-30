function changeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = t;
            }
        }
    }

    r.open("POST", "SignUpProcess.php", true);
    r.send(form);
}

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
        }
    };

    r.open("POST", "SignInProcess.php", true);
    r.send(form);
}

var bm;

function forgotpassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                alert("Verification Code Sent to Your Email. Please Check the Inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "ForgotPasswordProcess.php?e=" + email.value, true);
    r.send();
}

function showPassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {

        np.type = "text";
        npb.innerHTML = "Hide";

    } else {

        np.type = "password";
        npb.innerHTML = "Show";

    }
}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {

        rnp.type = "text";
        rnpb.innerHTML = "Hide";

    } else {

        rnp.type = "password";
        rnpb.innerHTML = "Show";

    }
}

function resetPassword() {
    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Password reset success.");
                bm.hide();
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}

function signOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "home.php";
            }
        }
    };

    r.open("GET", "SignOutProcess.php", true);
    r.send();
}

function changeImage() {

    var image = document.getElementById("profileimg");
    var prev = document.getElementById("prev0");

    image.onchange = function() {

        var file0 = this.files[0];
        var url0 = window.URL.createObjectURL(file0);
        prev.src = url0;
    }
}

function updateprofile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var addressline1 = document.getElementById("addline1");
    var addressline2 = document.getElementById("addline2");
    var city = document.getElementById("usercity");
    var image = document.getElementById("profileimg");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", addressline1.value);
    form.append("a2", addressline2.value);
    form.append("c", city.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

function pswd_addon() {

    var show_text = document.getElementById("show_text");
    var img_show = document.getElementById("img_show");
    var img_hide = document.getElementById("img_hide");

    var show = img_show.classList.toggle("d-none");
    var hide = img_hide.classList.toggle("d-none");

    if (hide == false) {

        show_text.type = "text";
        img_hide.className = "bi-eye-slash-fill";

    } else {

        show_text.type = "password";
        img_show.className = "bi-eye-fill";

    }
}

function changeProductImg() {

    var image = document.getElementById("imageUploader");
    var view = document.getElementById("prev");
    // var view1 = document.getElementById("prev1");
    // var view2 = document.getElementById("prev2");

    image.onchange = function() {
        var file = this.files[0];
        // var file1 = this.files[1];
        // var file2 = this.files[2];

        var url = window.URL.createObjectURL(file);
        // var url1 = window.URL.createObjectURL(file1);
        // var url2 = window.URL.createObjectURL(file2);

        view.src = url;
        // view1.src = url1;
        // view2.src = url2;
    }
}

function addProduct() {

    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var condition = 0;

    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }

    var color = 0;

    if (document.getElementById("clr1").checked) {
        color = 1;
    } else if (document.getElementById("clr2").checked) {
        color = 2;
    } else if (document.getElementById("clr3").checked) {
        color = 3;
    } else if (document.getElementById("clr4").checked) {
        color = 4;
    } else if (document.getElementById("clr5").checked) {
        color = 5;
    } else if (document.getElementById("clr6").checked) {
        color = 6;
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    var f = new FormData();
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("img", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "addproduct.php";
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    }
    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

function changeStatus(id) {
    var productId = id;
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLabel = document.getElementById("checkLabel" + productId);

    var status;
    if (statusChange.checked) {
        status = 0;
    } else {
        status = 1;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Deactivated") {
                statusLabel.innerHTML = "Make Your Product Active";
            } else if (text == "Activated") {
                statusLabel.innerHTML = "Make Your Product Deactive";
            }
        }
    }
    r.open("GET", "statusChangeProcess.php?p=" + productId + "&s=" + status, true);
    r.send();
}

function addFilters() {

    var search = document.getElementById("s");
    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var form = new FormData();
    form.append("s", search.value);
    form.append("a", age);
    form.append("q", qty);
    form.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            t = r.responseText;

            document.getElementById("sort").innerHTML = t;
        }
    };
    r.open("POST", "sortProcess.php", true);
    r.send(form);

}

function clearFilters() {
    // window.location = "myProducts.php";
    window.location.reload();
}

function sendId(id) {

    var id1 = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };
    r.open("GET", "sendProductProcess.php?id=" + id1, true);
    r.send();

}

function updateProduct() {

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUploader");

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("c", cost.value);
    form.append("dwc", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };
    r.open("POST", "updateProcess.php", true);
    r.send(form);
}

function advancedSearch(x) {

    var searchtxt = document.getElementById("s1");
    var category = document.getElementById("ca1");
    var barnd = document.getElementById("br1");
    var model = document.getElementById("mo1");
    var condition = document.getElementById("co1");
    var colour = document.getElementById("col1");
    var priceFrom = document.getElementById("pf1");
    var priceTo = document.getElementById("pt1");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("page", x);
    form.append("s", searchtxt.value);
    form.append("ca", category.value);
    form.append("b", barnd.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", colour.value);
    form.append("pf", priceFrom.value);
    form.append("pt", priceTo.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("results").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);

}

function basicSearch(x) {
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    var form = new FormData();
    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    };
    r.open("POST", "basicSearchProcess.php", true);
    r.send(form);

}

function loadmainimg(id) {
    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";
}

function qty_inc(qty) {

    var qty1 = qty;

    var input = document.getElementById("qtyinput");

    if (input.value < qty1) {

        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();
    } else {

        alert("Maximum quantity has achieved.");

    }

}

function qty_dec(qty) {

    var input = document.getElementById("qtyinput");

    if (input.value > 1) {

        var newvalue = parseInt(input.value) - 1;

        input.value = newvalue.toString();
    } else {
        alert("Minimum has achieved.");
    }
}

function check_val(qty) {

    var input = document.getElementById("qtyinput");

    if (input.value > qty) {
        alert("Insufficient quantity.");
        input.value = qty;
    }
}

//watchlist
function addToWatchlist(id) {

    var wid = id;

    var icon = document.getElementById("heart");
    icon.style.color = "red";

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location.reload();
            alert(t);
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();
}

function deleteFromWatchlist(id) {

    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "deleteWatchlistProcess.php?id=" + pid, true);
    r.send();
}
//watchlist

// cart
function addToCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please sign in first.") {
                alert(t);
                window.location = "index.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("product added to the recent successfully.");
                alert("Product removed from the cart successfully.");
                window.location = "cart.php";
            }
        }
    }
    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}
// cart

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}



function customerLogin() {
    window.location = "index.php";
}

var k;

function adminVerification() {

    var e = document.getElementById("e");

    var form = new FormData();
    form.append("e", e.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                var verificationModal = document.getElementById("verification_model");
                k = new bootstrap.Modal(verificationModal);

                k.show(verificationModal);
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);

}

function verify() {

    var v = document.getElementById("vcode");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                k.hide();
                window.location = "adminPanel.php"
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "verificationProcess.php?id=" + v.value, true);
    r.send();
}

var mm;

function viewMsgModal() {

    var m = document.getElementById("viewMsgModal");
    mm = new bootstrap.Modal(m);
    mm.show();
}

var pm;

function viewProductModal(id) {

    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;

function addNewCategory() {

    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();

}

var cvm;
var newCategory;
var uemail;

function categoryVerifyModal() {

    var m = document.getElementById("addCategoryModalVerification");
    cvm = new bootstrap.Modal(m);

    newCategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("n", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                cm.hide();
                cvm.show();
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);

}

function productBlock(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location = "manageproducts.php";
        }
    };
    r.open("GET", "productBlockProcess.php?id=" + id, true);
    r.send();
}

function userBlock(email) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location = "manageusers.php";
        }
    };
    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();
}

function saveCategory() {

    var text = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t", text);
    f.append("c", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                cvm.hide();
                alert("New Category added.");
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "saveNewCategoryProcess.php", true);
    r.send(f);
}

function changeInvoiceId(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shopping";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "disabled";
            }
            window.location = "sellingHistory.php";
        }
    }

    r.open("GET", "changeInvoiceIdProcess.php?id=" + id, true);
    r.send();
}

function invoiceSearch() {
    var txt = document.getElementById("search");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("box").innerHTML = "";
            document.getElementById("loadResults").innerHTML = t;
        }
    }
    r.open("GET", "invoiceSearch.php?t=" + txt.value, true);
    r.send();
}

function findSellings() {
    var from = document.getElementById("from");
    var to = document.getElementById("to");

    var f = new FormData();
    f.append("f", from.value);
    f.append("t", to.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("loadResults").innerHTML = t;

        }
    }
    r.open("POST", "findSellingsProcess.php", true);
    r.send(f);

}

function viewRecent() {

    var msgbox = document.getElementById("message_box");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
        }
    }
    r.open("GET", "viewRecentMsgProcess.php", true);
    r.send();
}

function viewMessages(email) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }
    r.open("GET", "viewMessagesProcess.php?email=" + email, true);
    r.send();
}

function sendMsg() {
    var recever_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("r", recever_mail.innerHTML);
    f.append("m", msg_txt.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "message.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

function saveFeed(id) {

    var type;

    if (document.getElementById("r1").checked) {
        type = 1;
    } else if (document.getElementById("r2").checked) {
        type = 2;
    } else if (document.getElementById("r3").checked) {
        type = 3;
    }

    var email = document.getElementById("e").value;
    var feedback = document.getElementById("f").value;

    var pid = id;

    var f = new FormData();
    f.append("t", type);
    f.append("e", email);
    f.append("f", feedback);
    f.append("i", pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "singleProductView.php?id=" + pid;
            }
            alert(t);
        }
    }
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

function buynow(id) {

    var product_id = id;
    // var product_qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("pid", product_id);
    // f.append("pqty", product_qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "invoice.php?order_id=" + t;
            // alert(t);
        }
    }
    r.open("POST", "buyNowProcess.php", true);
    r.send(f);

}

function checkOut1(id) {

    var product_id = id;
    var product_qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("pid", product_id);
    f.append("pqty", product_qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // window.location = "checkOut.php?order_id=" + t;
            window.location = "checkOut.php";
        }
    }
    r.open("GET", "checkOut.php?pid=" + t, true);
    r.send(f);

}

function checkOut(id) {

    var product_id = id;
    var product_qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("pid", product_id);
    f.append("pqty", product_qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "checkOut.php?pid=" + t;
        }
    }
    r.open("POST", "checkOutProcess.php", true);
    r.send(f);

}