///////////////////////////////////////////////////////////////////////////////////
///////////////////// Select Avatar (settings) ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function getImgSrc(param) {
    $(param).parent().find('.clicked-img').removeClass("clicked-img");
    $(param).addClass("clicked-img");
};

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Save Avatar (settings) ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#save').on('click', function() {
    var str = $('.tab-content').find('.clicked-img').attr("src");
    $("#avatarget").attr("src", str);


});

///////////////////////////////////////////////////////////////////////////////////
////////////////// Change User / Avatar (settings) ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function change_avatar_user(pass) {
    var password = $('#pass').val();
    var encrpted_password = CryptoJS.MD5(password).toString();
    var encrpted_pass = CryptoJS.MD5(pass).toString();
    if (pass === encrpted_password) {
        var avatar = $('#avatarget').attr("src");
        var old_name = $('#get_old_name').val();
        var new_name = $('#inputUsername').val();
        $.ajax({
            url: "../controller/change_avatar_user.php",
            type: "POST",
            data: { 'oldname': old_name, 'newname': new_name, 'avatar': avatar, 'password': encrpted_password },
            datatype: 'html',
            success: function(response) {
                if (response == "True") {
                    Swal.fire({
                        title: new_name,
                        text: 'Your username and avatar changed successfully !',
                        imageUrl: avatar,
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    }).then(function() {
                        location.reload();
                    })
                } else if (new_name == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'fill UserName !!',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'password incorrect !',
                    })
                }
            },
        });
    } else {
        alert('nope ! ');
    }
}

///////////////////////////////////////////////////////////////////////////////////
////////////// ADD Image (Add article / Edit Article) /////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);
        $('#img_123').attr("src", "#");
        $('#img_123').hide();

    } else {
        removeUpload();
    }
}

function removeUpload(input) {
    console.log(input.files[0]);
    $('.file-upload-image').attr('src', '#');
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();

    //$('.image-upload-wrap').show();
}

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// check Password (settings) /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function check() {
    var pwdId = document.getElementById('pwdId').value;
    var CpwdId = document.getElementById('CpwdId').value;
    var strength = 0;

    if (pwdId.length > 8) {
        strength += 1;
    }
    if (pwdId.match(/[a-z]+/)) {
        strength += 1;
    }
    if (pwdId.match(/[A-Z]+/)) {
        strength += 1;
    }
    if (pwdId.match(/[0-9]+/)) {
        strength += 1;
    }
    if (pwdId.match(/[$@#&-+*/&!]+/)) {
        strength += 1;
    }
    switch (strength) {
        case 0:
        case 1:
        case 2:
        case 3:
        case 4:
            $('#pwdId').addClass('is-invalid');
            $('#pwdId').removeClass('is-valid');
            $('#pwdInvalid').show();
            $('#pwdValid').hide();

            break;
        case 5:
            $('#pwdId').removeClass('is-invalid');
            $('#pwdId').addClass('is-valid');
            $('#pwdInvalid').hide();
            $('#pwdValid').show();
            break;

    }
}

///////////////////////////////////////////////////////////////////////////////////
///////////////////// confirme password (settings) ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function verif_confirme() {
    var pwdId = document.getElementById('pwdId').value;
    var CpwdId = document.getElementById('CpwdId').value;
    if (CpwdId == "") {
        $('#CpwdId').removeClass('is-invalid');
        $('#CpwdId').removeClass('is-valid');
        $('#CpwdInalid').hide();
        $('#CpwdValid').hide();
    } else if (pwdId != CpwdId) {
        $('#CpwdId').addClass('is-invalid');
        $('#CpwdId').removeClass('is-valid');
        $('#CpwdInalid').show();
        $('#CpwdValid').hide();
    } else if (pwdId === CpwdId) {
        $('#CpwdId').addClass('is-valid');
        $('#CpwdId').removeClass('is-invalid');
        $('#CpwdInalid').hide();
        $('#CpwdValid').show();
    }
}

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Change Password (settings) ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function savepass(pass, user) {
    var psw = $('#old_pass').val();
    var new_psw = $('#pwdId').val();
    var encrpted_psw = CryptoJS.MD5(psw).toString();
    var encrpted_new_psw = CryptoJS.MD5(new_psw).toString();
    if (encrpted_psw == pass && $('#pwdId').hasClass('is-valid') && $('#CpwdId').hasClass('is-valid') && new_psw == $('#CpwdId').val()) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (xhttp.responseText == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Changed Successfully',
                    }).then(function() {
                        location.reload();
                    })
                }
            }
        };
        xhttp.open("POST", "../controller/change_password.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("psw=" + encrpted_new_psw + "&user=" + user);
    } else {
        if (psw == "" || new_psw == "" || $('#CpwdId').val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'fill inputs first !!!!!!',
            })
        } else if (encrpted_psw != pass) {
            Swal.fire({
                icon: 'error',
                title: 'Old password is incorrect',
            })
        } else if ($('pwdId').hasClass('is-invalid')) {
            Swal.fire({
                icon: 'error',
                title: '"' + new_psw + '" is not strong enough !',
            })
        } else if ($('CpwdId').hasClass('is-invalid') || $('CpwdId').val() != new_psw) {
            Swal.fire({
                icon: 'error',
                title: 'does not match !',
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'something wrong i can feel it !',
            })
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////
//////////////////// Add table Articles (Articles) ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#example tfoot th').each(function() {
    var title = $(this).text();
    if (title == "image" || title == "actions") {
        $(this).html('');
    } else {
        $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
    }
});

var table = $('#example').DataTable({
    initComplete: function() {
        this.api().columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }
});


table.columns([5, 6]).every(function() {

    var column = this;
    var select = $('<select class="form-control"><option value=""></option></select>')
        .appendTo($(column.footer()).empty())
        .on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
        });

    column.data().unique().sort().each(function(d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    });
});

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Add Article (Add article) /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


$('#article-submit').on('click', function() {
    var name = $('#name_art').val();
    var price = $('#price_art').val();
    var promo = $('#promo_art').val();
    var description = $('#description_art').val();
    var mark = $('#mark_art').children("option:selected").val();
    var image = $('#image_art').attr('src');
    if (name != "" && price != "" && description != "" && mark != 0 && image != "#") {
        $.ajax({
            url: "../controller/Add_Article.php",
            type: "POST",
            data: { 'name': name, 'price': price, 'promo': promo, 'description': description, 'mark': mark, 'image': image },
            cache: false,
            success: function(response) {
                alert(response);
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }
            },

        });
    } else {
        if (name == "" || price == "" || description == "" || mark == 0 || image == "#") {
            Swal.fire({
                icon: 'error',
                title: 'fill inputs first !!!!!!',
            })
        } else if (name.length < 2) {
            Swal.fire({
                icon: 'error',
                title: 'name must be atleast 2 chars',
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'something wrong i can feel it',
            })
        }

    }
});

///////////////////////////////////////////////////////////////////////////////////
////////////////////////// Edit Article (Article) /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#Edit_article_sub').on('click', function() {
    var id = $('#id_art_edit').val();
    var name = $('#name_art_edit').val();
    var oldname = $('#oldname_art_edit').val();
    var prix = $('#price_art_edit').val();
    var promo = $('#promo_art_edit').val();
    var description = $('#description_art_edit').val();
    var image = $('#image_art_edit').attr("src");
    var markid = $('#mark_art_edit').children("option:selected").val();
    console.log(id);
    console.log(name);
    console.log(oldname);
    console.log(prix);
    console.log(promo);
    console.log(description);
    console.log(markid);
    if (name != "" && prix != "" && promo != "" && description != "" && image != "#" && markid != 0) {
        $.ajax({
            url: "../controller/Edit_Article.php",
            type: "POST",
            data: {
                'id': id,
                'name': name,
                'prix': prix,
                'description': description,
                'image': image,
                'promo': promo,
                'idmark': markid,
                'oldname': oldname
            },
            success: function(response) {
                alert(response);
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist in ' + $('#mark_art_edit').children('option:selected').text() + ' choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Edited Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }


            },

        });
    } else if (name == "" || prix == "" || promo == "" || description == "" || image == "#") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to fill all inputs !!',
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something wrong 2 !!',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Delete Article (Article) //////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function Delete_Article(id) {
    Swal.fire({
        title: 'Do you want to delete this article ?',
        showDenyButton: true,
        confirmButtonText: `YES`,
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../controller/Delete_Article.php",
                type: "POST",
                data: {
                    'id': id
                },
                success: function(response) {
                    if (response == "True") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted !',
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                },

            });

        }
    })
}

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Add Categorie (Categorie) /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#add_submit_cat').on('click', function() {
    var name = $('#add_categorie_input').val();
    if (name != "") {
        $.ajax({
            url: "../controller/Add_Categorie.php",
            type: "POST",
            data: { 'name': name },
            cache: false,
            success: function(response) {
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }
            },

        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name First !',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Delete Categorie (Categorie) //////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#delete_submit_cat').on('click', function() {
    var catid = $('#categorie_list_delete').children("option:selected").val();
    var nom = $('#categorie_list_delete').children("option:selected").text();
    if (catid != 0) {
        Swal.fire({
            title: 'Do you want to delete ' + nom + ' ?',
            showDenyButton: true,
            confirmButtonText: `YES`,
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../controller/Delete_Categorie.php",
                    type: "POST",
                    data: {
                        'id': catid
                    },
                    success: function(response) {
                        if (response == "True") {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }

                });

            }
        })

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to choose a Categorie First !',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
/////////////////////// Edit Categorie (Categorie) ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#edit_submit_cat').on('click', function() {
    var name = $('#edit_categorie_input').val();
    var catid = $('#categorie_list_edit').children("option:selected").val();
    if (catid != 0 && name != "") {
        $.ajax({
            url: "../controller/Edit_Categorie.php",
            type: "POST",
            data: {
                'catid': catid,
                'name': name
            },
            cache: false,
            success: function(response) {
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Edited Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }


            },

        });
    } else if (name == "" && catid == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name and choose a Categorie !',
        })
    } else if (name == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name First !',
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to choose a Categorie !',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Add Mark (Mark) //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#add_submit_mark').on('click', function() {
    var name = $('#add_mark_input').val();
    var categorie = $('#categorie_list_add').children("option:selected").val();
    if (name != "" && categorie != 0) {
        $.ajax({
            url: "../controller/Add_Mark.php",
            type: "POST",
            data: { 'name': name, 'categorie': categorie },
            cache: false,
            success: function(response) {
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }
            },

        });
    } else if (name == "" && categorie == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name and choose a categorie !',
        })
    } else if (name == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name First !',
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to choose a categorie !',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
///////////////////////// Delete Mark (Mark) //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#delete_submit_mark').on('click', function() {
    var markid = $('#mark_list_delete').children("option:selected").val();
    var nom = $('#mark_list_delete').children("option:selected").text();
    if (markid != 0) {
        Swal.fire({
            title: 'Do you want to delete ' + nom + ' ?',
            showDenyButton: true,
            confirmButtonText: `YES`,
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../controller/Delete_Mark.php",
                    type: "POST",
                    data: {
                        'id': markid
                    },
                    cache: false,
                    success: function(response) {
                        if (response == "True") {
                            Swal.fire(
                                'Deleted!',
                                'The Mark has been deleted.',
                                'success'
                            ).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }

                });

            }
        })

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to choose a Mark First !',
        })
    }
});

///////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Edit Mark (Mark) //////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

$('#edit_submit_mark').on('click', function() {
    var name = $('#edit_mark_input').val();
    var markid = $('#mark_list_edit').children("option:selected").val();
    if (markid != 0 && name != "") {
        $.ajax({
            url: "../controller/Edit_Mark.php",
            type: "POST",
            data: {
                'markid': markid,
                'name': name
            },
            success: function(response) {
                if (response == "False") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: name + ' exist choose another name !',
                    })
                } else if (response == "True") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added Successfully',
                    }).then(function() {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ' Something wrong !',
                    })
                }


            },

        });
    } else if (name == "" && markid == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name and choose a Mark !',
        })
    } else if (name == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to write a name First !',
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have to choose a Mark !',
        })
    }
});

////////////////////////////////////////////////////////////////////////////////////////