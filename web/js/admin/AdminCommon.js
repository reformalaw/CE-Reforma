function in_array(obj,arr) {
    for(c in arr){
        if (arr[c] === obj) {
            return true;
        }
    }
    return false;
}
/*Adding Custom Function For Browser Compatibility Start*/
//.filter(function(el,i,a){if(i==a.indexOf(el))return 1;return 0});
if (!Array.prototype.filter){
    Array.prototype.filter = function(fun /*, thisp */){
    "use strict";
    if (this == null)
    throw new TypeError();

    var t = Object(this);
    var len = t.length >>> 0;
    if (typeof fun != "function")
    throw new TypeError();

    var res = [];
    var thisp = arguments[1];
    for (var i = 0; i < len; i++){
        if (i in t){
            var val = t[i]; // in case fun mutates this
            if (fun.call(thisp, val, i, t))
            res.push(val);
        }
    }

    return res;
    };
}
//a.indexOf(el)
if (!Array.prototype.indexOf){
[].indexOf || (Array.prototype.indexOf = function(v){
    for(var i = this.length; i-- && this[i] !== v;);
    return i;
});
}
/*Adding Custom Function For Browser Compatibility End*/
// JScript File
//Opening a new window Starts Here
var win= null;
function NewWindow(mypage,myname,w,h,scroll,resize){
    var winl = (window.screen.width-w)/2;
    var wint = (window.screen.height-h)/2;
    var settings  ='height='+h+',';
    settings +='width='+w+',';
    settings +='top='+wint+',';
    settings +='left='+winl+',';
    settings +='scrollbars='+scroll+',';
    settings +='resizable='+resize+'';
    win=window.open(mypage,myname,settings);
    if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
//Opening a new window Ends Here

function validateUserSearch(){
    jQuery("#dateError").hide();
    //jQuery("#searchCountError").hide();
    fromDate = jQuery("#search_admin_case_FromDate").val();
    toDate = jQuery("#search_admin_case_ToDate").val();
    var errorCount = 0;



    if(!isValidDateRange(jQuery("#search_admin_case_FromDate").val(),jQuery("#search_admin_case_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }
    //alert(errorCount);
    /*if(jQuery("#search_admin_case_searchCount").val() !="" && ! isInteger(jQuery("#search_admin_case_searchCount").val())){
    jQuery("#searchCountError").show();
    jQuery("#searchCountError").html("Digit Only.");
    errorCount = errorCount+1;
    }*/
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}

function validateCustomerSearch(){
    jQuery("#dateError").hide();
    //jQuery("#searchCountError").hide();
    fromDate = jQuery("#search_customer_case_FromDate").val();
    toDate = jQuery("#search_customer_case_ToDate").val();
    var errorCount = 0;



    if(!isValidDateRange(jQuery("#search_customer_case_FromDate").val(),jQuery("#search_customer_case_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }
    //alert(errorCount);
    /*if(jQuery("#search_admin_case_searchCount").val() !="" && ! isInteger(jQuery("#search_admin_case_searchCount").val())){
    jQuery("#searchCountError").show();
    jQuery("#searchCountError").html("Digit Only.");
    errorCount = errorCount+1;
    }*/
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}
function validateWinnerSearch(){
    jQuery("#dateError").hide();
    if(isValidDateRange(jQuery("#WinnerSearch_fromDate").val(),jQuery("#WinnerSearch_toDate").val())){
        return true;
    }else{
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        return false;
    }
}
/*function isValidDateRange(fromDate,toDate){
if(fromDate!="" || toDate!=""){
var sarr = trim(fromDate).split('-');
var earr = trim(toDate).split('-');
var sdate = new Date(sarr[0],sarr[1]-1,sarr[2],0,0,0);
var edate = new Date(earr[0],earr[1]-1,earr[2],0,0,0);
if(sdate > edate){
return false;
}
}
return true
}*/


function isValidDateRange(fromDate,toDate){
    if(fromDate!="" || toDate!=""){
        var sarr = trim(fromDate).split('/');
        var earr = trim(toDate).split('/');
        var sdate = new Date(sarr[2],sarr[0]-1,sarr[1],0,0,0);
        var edate = new Date(earr[2],earr[0]-1,earr[1],0,0,0);
        if(sdate > edate){
            return false;
        }
    }
    return true
}

function validateDateRange(startDateId,endDateId){
    jQuery("#dateError").hide();
    if(isValidDateRange(jQuery("#"+startDateId).val(),jQuery("#"+endDateId).val())){
        return true;
    }else{
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        return false;
    }
}
// Removes leading whitespaces
function LTrim( value ) {
    var re = /\s*((\S+\s*)*)/;
    return value.replace(re, "$1");
}

// Removes ending whitespaces
function RTrim( value ) {
    var re = /((\s*\S+)*)\s*/;
    return value.replace(re, "$1");
}

// Removes leading and ending whitespaces
function trim( value ) {
    return LTrim(RTrim(value));
}
/*** Function for the cheking the intiger value **/
function isInteger(s){
    var i;
    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function upDownNumber(keycode,elementId){
    var value = jQuery("#"+elementId).val();
    if(isNaN(parseInt(value * 1))){
        value=0;
    }
    if(keycode==38){
        value = Number(value) + 1;
    }
    if(keycode==40){
        value = Number(value) - 1;
        if(value<1){
            value = 1;
        }
    }
    jQuery("#"+elementId).val(value);
}
function validateQuantity(){
    jQuery("#searchCountError").hide();
    errorCount =0;
    jQuery("#PrizeSearchForm_quantity").removeClass('error');
    jQuery("#PrizeSearchForm_prizeWon").removeClass('error');
    if(jQuery("#PrizeSearchForm_quantity").val() !="" && ! isInteger(jQuery("#PrizeSearchForm_quantity").val())){
        jQuery("#PrizeSearchForm_quantity").addClass('error');
        errorCount++;
    }
    if(jQuery("#PrizeSearchForm_prizeWon").val() !="" && ! isInteger(jQuery("#PrizeSearchForm_prizeWon").val())){
        jQuery("#PrizeSearchForm_prizeWon").addClass('error');
        errorCount++;
    }
    if(errorCount>0){
        jQuery("#searchCountError").show();
        jQuery("#searchCountError").html("Digit Only.");
        return false;
    }
    return true;
}

function deleteConfirmation()
{
    var ans = confirm("Are you sure you want to delete?");
    if(ans)
    return true;
    else
    return false;
}

function deletePhysicallyConfirmation()
{
    var ans = confirm("Are you sure you want to delete case ? It will be removed permanently");
    if(ans)
    return true;
    else
    return false;
}

function deletePracticeAreaConfirmation(level)
{
    if(level == 0)
    {
        var ans = confirm("Are you sure you want to delete parent parents and it's child category ?");
    }else if(level == 1){
        var ans = confirm("Are you sure you want to delete parent parents and it's child category ?");
    }else{
        var ans = confirm("Are you sure you want to delete sub-child category ?");
    }
    if(ans)
    return true;
    else
    return false;
}

function validateCustomerPayReportSearch(){
    jQuery("#dateError").hide();
    jQuery("#searchAmountError").hide();
    fromDate = jQuery("#search_FromDate").val();
    toDate = jQuery("#search_ToDate").val();
    //alert(fromDate);
    //alert(toDate);

    var errorCount = 0;
    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }


    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {
        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;
        
        if( st > et  )   {
            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
        }
    }

    //alert(errorCount);
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}


function validateThirdPartyPayReportSearch(){
    jQuery("#dateError").hide();
    jQuery("#searchAmountError").hide();
    fromDate = jQuery("#search_FromDate").val();
    toDate = jQuery("#search_ToDate").val();
    //alert(fromDate);
    //alert(toDate);

    var errorCount = 0;
    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }


    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {

        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;
        
        if( st > et  )   {
            
            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
            
        }
    }

    
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}


function validateUnpaidCustomer() {
    jQuery("#searchAmountError").hide();
    var errorCount = 0;

    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {
        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;

        if( st > et )   {
            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
        }
    }

    //alert(errorCount);
    if(errorCount==0){
        return true;
    }else{
        return false;
    }


}


function validateUnpaidThirdParty() {
    jQuery("#searchAmountError").hide();
    var errorCount = 0;

    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {
        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;

        if( st > et )   {
            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
        }
    }

    //alert(errorCount);
    if(errorCount==0){
        return true;
    }else{
        return false;
    }

}

function validatePaymentReport() {
    jQuery("#dateError").hide();
    jQuery("#searchAmountError").hide();
    fromDate = jQuery("#search_FromDate").val();
    toDate = jQuery("#search_ToDate").val();

    var errorCount = 0;
    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }


    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {
        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;

        if( st > et )   {

            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
        }
    }

    //alert(errorCount);
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}

function validateFinance() {
    jQuery("#dateError").hide();

    var errorCount = 0;
    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = errorCount+1;
    }

    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}


function validateActivity(){
    jQuery("#dateError").hide();
    fromDate = jQuery("#search_FromDate").val();
    toDate = jQuery("#search_ToDate").val();
    var errorCount = 0;

    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }

    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}


function validateDashboardPaymentReport() {
    jQuery("#dateError").hide();
    jQuery("#searchAmountError").hide();

    var errorCount = 0;

    if(!isValidDateRange(jQuery("#search_FromDate").val(),jQuery("#search_ToDate").val())){
        jQuery("#dateError").show();
        jQuery("#dateError").html("Invalid Date Range.");
        errorCount = parseInt(errorCount)+1;
    }


    if(jQuery("#search_StartAmount").val() !="" && ! isInteger(jQuery("#search_StartAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }


    if(jQuery("#search_EndAmount").val() !="" && ! isInteger(jQuery("#search_EndAmount").val())){
        jQuery("#searchAmountError").show();
        jQuery("#searchAmountError").html("Amount in Digit Only.");
        errorCount = parseInt(errorCount)+1;
    }

    if(jQuery("#search_StartAmount").val() !="" &&  isInteger(jQuery("#search_StartAmount").val()) &&
    jQuery("#search_EndAmount").val() !="" && isInteger(jQuery("#search_EndAmount").val())
    )

    {
        var st = parseInt(trim(jQuery("#search_StartAmount").val())) ;
        var et = parseInt(trim(jQuery("#search_EndAmount").val())) ;

        if( st > et )   {
            alert('heee');
            jQuery("#searchAmountError").show();
            jQuery("#searchAmountError").html("Invalid Amount Entered");
            errorCount = parseInt(errorCount)+1;
        }
    }

    //alert(errorCount);
    if(errorCount==0){
        return true;
    }else{
        return false;
    }
}

function closeConfirmation() // Function will Ask Notification for closing case
{
    var ans = confirm("Are you sure you want to Close this Case ?");
    if(ans)
    return true;
    else
    return false;
}

function PracticeAreaExist()
{
    alert("This page cannot be deactivated or deleted because it is currently linked to a  Menu item. Please remove the link before deactivating or deleting this page.");
}

function CmsPageExist()
{
    alert("This page cannot be deactivated or deleted because it is currently linked to a  Menu item. Please remove the link before deactivating or deleting this page.");
}

function setThemeConfirmation()
{
    var ans = confirm("Are you sure you want to set this theme ?");
    if(ans)
    return true;
    else
    return false;
}
