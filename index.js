$(document).ready(function () {
    // Fetch All Records
    function loadTable() {
        $("#load-table").html("");
        $.ajax({
            url: 'http://localhost/project%202/apiFetchAll.php',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                if (data.status == false) {
                    $("#load-table").append("<tr><td colspan='4'><h2>" + data.message + "</h2></td></tr>");

                } else {
                    $.each(data, function (key, value) {
                        $("#load-table").append("<tr>"
                            + "<td>" + value.enroll + "</td>" +
                            "<td>" + value.name + "</td>" +
                            "<td><input type='radio' name='" + value.enroll + "' value='present'></td>" +
                            "<td><input type='radio' name='" + value.enroll + "' value='absent'></td>" +
                            "<td><button class='editbtn' type='button' data-eid='" + value.enroll + "'>Edit</button></td>" +
                            "<td><button class='delbtn' type='button' data-id='" + value.enroll + "'>Delete</button></td>" +
                            "</tr>");
                    });
                }
            }
        });
    }
    loadTable();

    // Show Success or Error Messages
    function message(message) {
        alert(message);
    }


    //Function for form data to json object
    function jsonData(targetform) {
        var arr = $(targetform).serializeArray();
        var obj = {};
        for (var a = 0; a < arr.length; a++) {
            if (arr[a].value == "") {
                return false;
            }
            obj[arr[a].name] = arr[a].value;
        }
        var json_string = JSON.stringify(obj);
        return json_string;
    }

    //Fetch single
    $(".mod").hide();
    $(document).on("click", ".editbtn", function () {
        $(".mod").show();
        var eno = $(this).data("eid");
        var obj = { enroll: eno };
        var myJSON = JSON.stringify(obj);
        $.ajax({
            url: 'http://localhost/project%202/apiFetchSingle.php',
            type: "POST",
            data: myJSON,
            success: function (data) {
                $("#enroll").val(data[0].enroll);
                $("#name").val(data[0].name);
            }
        });
    });
    $("#close").click(function () {
        $(".mod").hide();
    });


    $(".mod1").hide();
    $(document).on("click", "#add", function () {
        $(".mod1").show();
    });
    $("#close1").click(function () {
        $(".mod1").hide();
    });

    // Insert New Record
    $("#add1").on("click", function (e) {
        e.preventDefault();
        var jsonObj = jsonData("#addForm");
        if (jsonObj == false) {
            message("All fields are required.");
        } else {
            $.ajax({
                url: 'http://localhost/project%202/apiInsert.php',
                type: "POST",
                data: jsonObj,
                success: function (data) {
                    message(data.message);
                    if (data.status == true) {
                        loadTable();
                        $("#addForm").trigger("reset");
                    }
                }
            });
        }
    });

    //Update a record
    $("#update").on("click", function (e) {
        e.preventDefault();
        var jsonObj = jsonData("#editForm");
        if (jsonObj == false) {
            message("All fields are required.");
        } else {
            $.ajax({
                url: 'http://localhost/project%202/apiUpdate.php',
                type: "POST",
                data: jsonObj,
                success: function (data) {
                    message(data.message);
                    if (data.status == true) {
                        $(".mod").hide();
                        loadTable();
                    }
                }
            });
        }
    });

    // Delete Record
    $(document).on("click", ".delbtn", function () {
        if (confirm("Do you really want to delete this record? ")) {
            var eno = $(this).data("id");
            var obj = { enroll: eno };
            var myJSON = JSON.stringify(obj);
            var row = this;
            $.ajax({
                url: 'http://localhost/project%202/apiDelete.php',
                type: "POST",
                data: myJSON,
                success: function (data) {
                    message(data.message);
                    if (data.status == true) {
                        $(row).closest("tr").fadeOut();
                    }
                }
            });
        }
    });

    // Live Search Record

    function searchFunc() {
        var search_term = $("#search").val();
        $("#load-table").html("");
        var obj = { search: search_term };
        var myJSON = JSON.stringify(obj);

        $.ajax({
            url: "http://localhost/project%202/apiSearch.php",
            type: "POST",
            data: myJSON,
            success: function (data) {
                if (data.status == false) {
                    $("#load-table").append("<tr><td colspan='6'><h2>" + data.message + "</h2></td></tr>");

                } else {
                    $.each(data, function (key, value) {
                        $("#load-table").append("<tr>"
                            + "<td>" + value.enroll + "</td>" +
                            "<td>" + value.name + "</td>" +
                            "<td><input type='radio' name='" + value.enroll + "' value='present'></td>" +
                            "<td><input type='radio' name='" + value.enroll + "' value='present'></td>" +
                            "<td><button class='editbtn' type='button' data-eid='" + value.enroll + "'>Edit</button></td>" +
                            "<td><button class='delbtn' type='button' data-id='" + value.enroll + "'>Delete</button></td>" +
                            "</tr>");
                    });
                }
            }
        });
    }

    $("#search2").hide();

    function searchFunc2() {
        var search_val = $("#search2").val();
        $("#loadTable2").html("");
        var obj = { search: search_val };
        var myJSON = JSON.stringify(obj);

        $.ajax({
            url: "http://localhost/project%202/searchApi.php",
            type: "POST",
            data: myJSON,
            success: function (data) {
                if (data.status == false) {
                    $("#loadTable2").append("<tr><td colspan='3'><h2>" + data.message + "</h2></td></tr>");

                } else {
                    $.each(data, function (key, value) {
                        $("#loadTable2").append("<tr>"
                            + "<td>" + value.enrollNo + "</td>" +
                            "<td>" + value.AbsentPresent + "</td>" +
                            "<td>" + value.entryDate + "</td>" +
                            "</tr>");
                    });
                }
            }
        });
    }
    $(".makeSearch").on("keyup", function () {
        searchFunc();
    });

    $("#search2").on("keyup", function () {
        searchFunc2();
    });

    //For radio data 

    $("#radioForm").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var jsonObj = jsonData("#radioForm");
        if (jsonObj == false) {
            message("All fields are required.");
        } else {
            $.ajax({
                url: 'http://localhost/project%202/radio.php',
                type: "POST",
                data: jsonObj,
                success: function (data) {
                    message(data.message);
                    if (data.status == true) {
                        $("#radioForm").trigger("reset");
                    }
                }
            });
        }

    });

    //Fetch record using date
    $("#tab2").hide();
    $("#clear").hide();
    $("#go1").on("click", function (e) {
        e.preventDefault();
        $("#tab2").show();
        $("#tab1").hide();
        $("#sub").hide();
        $("#tDate").hide();
        $(".dtxt").hide();
        $("#clear").show();
        $(".makeSearch").hide();
        $("#search2").show();
        var value = $("#cDate").val();
        $("#loadTable2").html("");
        var obj = { dateVal: value };
        var myJSON = JSON.stringify(obj);
        $.ajax({
            url: 'http://localhost/project%202/fetchRecords.php',
            type: "POST",
            data: myJSON,
            success: function (data) {
                if (data.status == false) {
                    $("#loadTable2").append("<tr><td colspan='3'><h2>" + data.message + "</h2></td></tr>");

                } else {
                    $.each(data, function (key, value) {
                        $("#loadTable2").append("<tr>"
                            + "<td>" + value.enrollNo + "</td>" +
                            "<td>" + value.AbsentPresent + "</td>" +
                            "<td>" + value.entryDate + "</td>" +
                            "</tr>");
                    });
                }
            }
        });
    });

    $("#clear").click(function () {
        loadTable();
        $("#tab1").show();
        $("#tab2").hide();
        $("#sub").show();
        $("#tDate").show();
        $(".dtxt").show();
        $("#clear").hide();
        $("#cDate").val("");
        $(".makeSearch").val("");
        $("#search2").val("");
        $(".makeSearch").show();
        $("#search2").hide();
    });

});

