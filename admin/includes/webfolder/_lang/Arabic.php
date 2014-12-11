<?php

// Arabic Language Module for v2.3 (translated by mhndm the phpTransformer project)

$GLOBALS["charset"] = "utf-8";
$GLOBALS["text_dir"] = "rtl"; // ('ltr' for left to right, 'rtl' for right to left)
$GLOBALS["date_fmt"] = "d/m/Y H:i";
$GLOBALS["error_msg"] = array(
// error
"error"=> "خطأ",
"back"=> "عودة",

// root
"home"=> "المجلد الرئيسي غير صحيح, نرجو تصحيح الاعدادات",
"abovehome"=> "المجلد الحالي قد لا يكون فوق المجلد الرئيسي",
"targetabovehome"=> "المجلد الهدف قد لا يكون فوق المجلد الرئيسي",

// exist
"direxist"=> "المجلد غير موجود",
//"filedoesexist"=> "This file already exists.",
"fileexist"=> "الملف غير موجود",
"itemdoesexist"=> "العنصر موجود مسبقاً",
"itemexist"=> "هذا العنصر غير موجود",
"targetexist"=> "المجلد الوجهة غير موجود",
"targetdoesexist"=> "العنصر الوجهة موجود مسبقاً",

// open
"opendir"=> "غير قادر على فتح المجلد",
"readdir"=> "غير قادر على قراءة المجلد",

// access
"accessdir"=> "ليس لديك صلاحية للوصول للمجلد هذا",
"accessfile"=> "ليس لديك صلاحية للوصول لهذا الملف",
"accessitem"=> "ليس لديك صلاحية للوصول الى هذا العنصر",
"accessfunc"=> "ليس لديك صلاحية لاستخدام هذه الدالة",
"accesstarget"=> "ليس لديك صلاحية للوصول الى المجلد الهدف",

// actions
"permread"=> "غير قادر على معرفة الصلاحيات",
"permchange"=> "فشلت عملية تغيير الصلاحيات",
"openfile"=> "فشلت عملية فتح الملف",
"savefile"=> "فشل في عملية حفظ الملف",
"createfile"=> "فشل في عملية انشاء ملف جديد",
"createdir"=> "فشل في عملية انشاء مجلد جديد",
"uploadfile"=> "فشل في عملية رفع ملف",
"copyitem"=> "فشلت عملية النسخ",
"moveitem"=> "فشلت عملية النقل",
"delitem"=> "فشلت عملية الحذف",
"chpass"=> "فشلت عملية تغيير عملية السر",
"deluser"=> "فشلت عملية حذف المستخدم",
"adduser"=> "فشلت عملية اضافة مستخدم جديد",
"saveuser"=> "فشلت عملية حفظ المستخدم",
"searchnothing"=> "يجب ان تخصص شيئا للبحث عنه",

// misc
"miscnofunc"=> "دالة غير متوفةر",
"miscfilesize"=> "تجاوز الملف الحد الاقصى",
"miscfilepart"=> "تم رفع جزء فقط من الملف",
"miscnoname"=> "يجب ان تحدد اسم",
"miscselitems"=> "لم تقم باختيار اي شيء",
"miscdelitems"=> "هل تريد بالفعل حذف  \"+num+\" عنصر?",
"miscdeluser"=> "هل تريد بالفعل حذف المستخدمين  '\"+user+\"'?",
"miscnopassdiff"=> "كلمة السر الجديدة لم تختلف عن القديمة",
"miscnopassmatch"=> "كلمات السر غير متطابقة",
"miscfieldmissed"=> "لقد نسيت حقل مطلوب",
"miscnouserpass"=> "الاسم او كلمة السر خطأ",
"miscselfremove"=> "لا تستطيع حذف نفسك",
"miscuserexist"=> "هذا المستخدم موجود مسبقاً",
"miscnofinduser"=> "المستخدم غير موجود",
);
$GLOBALS["messages"] = array(
// links
"permlink"=> "تغيير صلاحيات",
"editlink"=> "تحرير",
"downlink"=> "تنزيل",
"uplink"=> "أعلى",
"homelink"=> "الرئيسية",
"reloadlink"=> "تحديث",
"copylink"=> "نسخ",
"movelink"=> "نقل",
"dellink"=> "حذف",
"comprlink"=> "ارشيف",
"adminlink"=> "مدير",
"logoutlink"=> "خروج",
"uploadlink"=> "رفع",
"searchlink"=> "بحث",

// list
"nameheader"=> "اسم",
"sizeheader"=> "حجم",
"typeheader"=> "نوع",
"modifheader"=> "تعديل",
"permheader"=> "صلاحيات",
"actionheader"=> "عملية",
"pathheader"=> "مسار",

// buttons
"btncancel"=> "تراجع",
"btnsave"=> "حفظ",
"btnchange"=> "تغيير",
"btnreset"=> "تراجع",
"btnclose"=> "إغلاق",
"btncreate"=> "انشاء",
"btnsearch"=> "بحث",
"btnupload"=> "رفع",
"btncopy"=> "نسخ",
"btnmove"=> "نقل",
"btnlogin"=> "دخول",
"btnlogout"=> "خروج",
"btnadd"=> "اضافة",
"btnedit"=> "تحرير",
"btnremove"=> "حذف",

// actions
"actdir"=> "مجلد",
"actperms"=> "تغيير صلاحيات",
"actedit"=> "تحرير ملف",
"actsearchresults"=> "نتائج البحث",
"actcopyitems"=> "نسخ عناصر",
"actcopyfrom"=> "نسخ من /%s to /%s ",
"actmoveitems"=> "نقل عناصر",
"actmovefrom"=> "نقل من /%s to /%s ",
"actlogin"=> "دخول",
"actloginheader"=> "دخول لاستخادم WebFolder",
"actadmin"=> "إدارة",
"actchpwd"=> "تغيير كلمة السر",
"actusers"=> "مستخدمين",
"actarchive"=> "ارشفة عناصر",
"actupload"=> "رفع ملفات",

// misc
"miscitems"=> "عناصر",
"miscfree"=> "فارغة",
"miscusername"=> "اسم المستخدم",
"miscpassword"=> "كلمة السر",
"miscoldpass"=> "كلمة السر القديمة",
"miscnewpass"=> "كلمة سر جديدة",
"miscconfpass"=> "تاكيد كلمة السر",
"miscconfnewpass"=> "تاكيد كلمة السر الجديدة",
"miscchpass"=> "تغيير كلمة السر",
"mischomedir"=> "المجلد الرئيسي",
"mischomeurl"=> "العنوان الرئيسي",
"miscshowhidden"=> "مشاهدة العناصر المخفية",
"mischidepattern"=> "عناصر مخفية",
"miscperms"=> "صلاحيات",
"miscuseritems"=> "(اسم, مجلد رئيسي, مشاهدة عناصر مخفية, صلاحيات, نشط)",
"miscadduser"=> "اضافة مستخدم",
"miscedituser"=> "اضافة مستخدم '%s'",
"miscactive"=> "نشط",
"misclang"=> "لغة",
"miscnoresult"=> "النتيجة غير متوفرة",
"miscsubdirs"=> "بحث في المجلدات الفرعية",
"miscpermnames"=> array("مشاهدة فقط","تعديل","تغيير كلمة السر","تعديل و تغيير كلمة السر",
"مدير"),
"miscyesno"=> array("نعم","كلا","نعم","لا"),
"miscchmod"=> array("المالك", "المجموعة", "العام"),
);
?>