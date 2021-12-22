let id = $("input[name*='faculty_id']")
id.attr("readonly", "readonly");


$(".btnedit").click(e => {
    let textvalues = displayData(e);

    ;

    // let id = $("input[name*='faculty_id']");
    let facultyFname = $("input[name*='FacFirstName']");
    let facultyLname = $("input[name*='FacLastName']");
    let facultyOphone = $("input[name*='FacOfficePhone']");
    let facultypass = $("input[name*='FacPassword']");
    let facultylocation = $("input[name*='FacLocation']");
    let facultyphone = $("input[name*='FacPhone']");
    let facultyemail = $("input[name*='FacEmail']");
    let Depid = $("input[name*='DepID']");
    let Roleid = $("input[name*='RoleID']");

    id.val(textvalues[0]);
    facultyFname.val(textvalues[1]);
    facultyLname.val(textvalues[2]);
    facultyOphone.val(textvalues[3]);

    facultypass.val(textvalues[4]);
    facultylocation.val(textvalues[5]);
    facultyphone.val(textvalues[6]);

    facultyemail.val(textvalues[7]);
    Depid.val(textvalues[8]);
    Roleid.val(textvalues[9]);

});


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