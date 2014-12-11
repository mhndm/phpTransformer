// ** I18N

// Calendar Arabic language
// Encoding: UTF8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Calendar._DN = new Array
("الأحد",
 "الإثنين",
 "الثلاثاء",
 "الأربعاء",
 "الخميس",
 "الجمعة",
 "السبت",
 "الأحد");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("أحد",
 "إثنين",
 "ثلاثاء",
 "أربعاء",
 "خميس",
 "جمعة",
 "سبت",
 "أحد");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 0;

// full month names
Calendar._MN = new Array
("كانون2",
 "شباط",
 "’ذار",
 "نبسان",
 "أيار",
 "حزيران",
 "تموز",
 "آب",
 "أيلول",
 "تشرين1",
 "تشرين2",
 "كانون1");

// short month names
Calendar._SMN = new Array
("كانون2",
 "شباط",
 "آذار",
 "نيسان",
 "أيار",
 "حزيران",
 "تموز",
 "آب",
 "أيلول",
 "تشرين1",
 "تشرين2",
 "كانون1");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "حول الرزنامة";

Calendar._TT["ABOUT"] =
"انتقاء التاريخ:\n" +
"- استعمل \xab, \xbb لاختيار السنة\n" +
"- استعمل " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " لاختيار الاشهر\n" +
"- افلت المؤشر على اي من الازرار لاختيار سريع.";

Calendar._TT["ABOUT_TIME"] = "\n\n" +
"اختيار الوقت:\n" +
"- اكبس على مكان الوقت لزيادة الوقت\n" +
"- أو Shift-click لانقاصه\n" +
"- او اكبس و افلت لاختيار سريع.";

Calendar._TT["PREV_YEAR"] = "السنة السابقة (hold for menu)";
Calendar._TT["PREV_MONTH"] = "الشهر السابق (hold for menu)";
Calendar._TT["GO_TODAY"] = "اليوم الحالي";
Calendar._TT["NEXT_MONTH"] = "الشهر التالي (hold for menu)";
Calendar._TT["NEXT_YEAR"] = "السنة التالية (hold for menu)";
Calendar._TT["SEL_DATE"] = "اختر التاريخ";
Calendar._TT["DRAG_TO_MOVE"] = "اسحب لتنقل";
Calendar._TT["PART_TODAY"] = " (اليوم)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "اعرض %s اولا";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "اغلاق";
Calendar._TT["TODAY"] = "اليوم";
Calendar._TT["TIME_PART"] = "(Shift-)Click او اسحب لتيير القيمة";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "اسبوع";
Calendar._TT["TIME"] = "الوقت:";
