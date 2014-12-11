<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
*	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<p><strong>قاعدة البيانات<br />
</strong>إن معظم البيانات التي تدخلها يتم حفظها في قاعدة بيانات MySQL على خادم منفصل عن الخادم الفعلي الذي يعمل عليه الموقع لذلك فأنه من المؤكد عمليا أن تقوم بنسخ احتياطي لقاعدة البيانات عندك حتى إذا ما حدث خطأ ما للموقع أن تستطيع إستعادة آخر نسخة إحتياط تم انشاؤها من قبل, كما أن كثرة إستخدام قاعدة البيانات من إضافة و تعديل و حذف ينتج عنه فراغات لا داعي لها داخل ملف قاعدة البيانات على القرص الصلب و يزيد من حجمها لذلك ننصح كل فترة بعمل تحسين لها مما يحسن من أدائها.</p>
<p>نسخ احتياط :<br />
هي العملية التي تقوم بجلب كل معلومات قاعدة البيانات و تحفظهم بملف على القرص الصلب للخادم المضيف للموقع, شكل ان هذا الملف يمكن استعادته فيما بعد, لذلك لا بد أن يضع المدير مسار النسخ الاحتياطي بشكل صحيح و ان يتمكن البرنامج من الوصول الى هذا المسار, اثاناء سير عملية النسخ الاحتياطي سيتم تسجيل الاحداث ضمن هذه الشاشة للإطمئنان الى حسن سير العملية بنجاح.</p>
<p>استعادة نسخة:<br />
  إن أي خطأ يحدث للموقع و يؤدي الى تلف المعلومات يمكن أن يتم التغلب عليه من خلال الرجوع لأحدث نسخة احتياط تم انشائها من قبل, بكلام آخر ان استعادة نسخة احتياط يعني الرجوع بالموقع الى تاريخ سابق, لا تقوم باستعادة نسخة في حال كان موقعك يعمل بشكل جيد, كما ننصح أن تكون صلاحية الاستعادة موكل بالمدير &quot; آدم&quot;
فقط لدواعي امنية.<br />
يمكنك الملاحظة ان خلال الاستعادة عند انتقاء لملف سبق نسخه احتياطياً ستجد اسمه مكون من اسم قاعدة البيانات ملحقاً به التاريخ و الوقت و من بعده نص عشوائي لضمان عدم القدرة للوصول اليه بشكل مباشر من قبل المخربين.
</p>
<p>تحسين البيانات:<br />
المعلومات المخزنة في قاعدة البيانات هي في نهاية المضاف موجودة بملف ما على خادم قاعدة بيانات الموقع و عند استخادم جدول ما بشكل كثيف ينتج عنه وضع فراغات كبيرة داخل هذا الجدول, ان عملية التحسين هذه سوف تقوم بحذف هذه الفراغات و تقلل حجم قاعدة البيانات و تسرع العمل .</p>