let id = $("input[name*='students_id']")
id.attr("readonly", "readonly");

// get values from input forms
$(".btnedit").click(e => {
    let textvalues = displayData(e);

    ;

    // let id = $("input[name*='student_id']");
    let studentFname = $("input[name*='StudFirstName']");
    let studentLname = $("input[name*='StudLastName']");
    let studentaddress = $("input[name*='StudAddress']");
    let studentcity = $("input[name*='StudCity']");
    let studentcountry = $("input[name*='StudCountry']");
    let studentphone = $("input[name*='StudPhone']");
    let studentemail = $("input[name*='StudEmail']");
    let studentdob = $("input[name*='StudDOB']");
    let studentenrolled = $("input[name*='StudEnrolled']");
    let studentpass = $("input[name*='StudPassword']");
    let studentPIN = $("input[name*='StudPin']");
    let studentmid = $("input[name*='MajID']");
    let studentcid = $("input[name*='ClassID']");

    id.val(textvalues[0]);
    studentFname.val(textvalues[1]);
    studentLname.val(textvalues[2]);
    studentaddress.val(textvalues[3]);

    studentcity.val(textvalues[4]);
    studentcountry.val(textvalues[5]);
    studentphone.val(textvalues[6]);

    studentemail.val(textvalues[7]);
    studentdob.val(textvalues[8]);
    studenterolled.val(textvalues[9]);

    studentpass.val(textvalues[10]);
    studentPIN.val(textvalues[11]);
    studentmid.val(textvalues[12]);
    studentcid.val(textvalues[13]);

});

// return text values
function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td) {
        if (value.dataset.id == e.target.dataset.id) {
            textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}