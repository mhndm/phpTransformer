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
<p><strong>برنامج و بلوك التصويت :</strong></p>
<p>معظم المواقع التفاعلية تحتاج من وقت لآخر استفتاء زوارها عن حدث معين او أخذ رأيهم بقرار ما قبل اتخاذه, التصويت عادة نوعين واحد يجب ان يختار فيه المصوت خياراً واحداً فقط من جملة خيارات مثلا ان يختار جهة ما عدوا او صديقاً, و نوع آخر يستطيع فيه المصوت أن يأخذ بأكثر من خيار و مثال على ذلك &quot; ما هي أكلتك المفضلة ؟&quot; .<br />
التصويت عادة يكون له وقت محدد يبدا به و ينتهي فيه لفرز النتائج و تحليلها فيما بعد, نحن في phpTransformer وضعنا كل هذه الحلول مع اربعة خيارات افتراضية في كل تصويت كحد اقصى يمكن تعديلها برمجيا لاكثر من ذلك, كما انه في حال لم يتم ادخال نص في الخيار فسيتم تجاهله.</p>
<p>لقد تم وضع بعد الضوابط لضمان تصويت فعال دون تكرار من نفس المصوت بالاعتماد على رقم الجلسة للزائر و رقم الـ IP الخاص به و اسم العضو المصوت.</p>
<p>تصويت جديد :</p>
<p>فترة التصويت : هي الفترة الزمنية بالتوقيت الذي تم اختياره في الخيارت حسب منطقة غرينتش, هذه الفترة تمتد من تاريخ و وقت الى تاريخ ووقت اخر, عند وضع مؤشر الفأرة داخل هذه الحقوا ستظهر لك روزنامة يمكنك الاختيار منها لضمان كتابة التاريخ و الوقت بالتنسيق الصحيح.<br />
  في حال اردت ان يبدأ التصويت الآن دون تأخير يمكنك وضع قيمة تاريخ &quot; من &quot; صفر و اذا اردت ان يستمر التصويت الى ما لا نهاية ضع قيمة &quot; الى &quot; صفر .</p>
<p>لا يوجد تاريخ محدد: هذا الخيار سيصفر فترة التصويت في خانتي من و الى و سيكون التصويت دون مدة محددة.</p>
<p>جاهز للنشر: قد تعمد احيانا الى انشاء تصويت و لكن لا تريد نشره حاليا لسبب ما يمكنك وضع قيم كلا في هذا الخيار .</p>
<p>السماح لتعدد الخيارات: اذا وضعت قيم نعم في هذا الخيار , عندها يستطيع المصوت ان يضع علامة باكثر من خيار اثناء التصويت. و إلا سوف يجبر على انتقاء خيار واحد فقط.</p>
<p>عنوان التصويت : يكون عادة السؤال المطروح على المصوت , هذا الخيار يدعم تعدد اللغات.</p>
<p>الخيار : هي القيم التي سيختار منها المصوت , عند انتقائك لواحد منهم على انه افتراضي, فهذا سيجعله بحالة مختارة بشكل مسبق و يمكن للمصوت تغييره.</p>
<p>لائحة الاستفتاءات :</p>
<p>تظهر هذه الشاشة فارغة في حال لم تقم من قبل بادراج تصويت جديد او قمت بحذف جميع التصويتات السابقة. من خلال هذه الشاشة يمكنك استعراض الاستفتاءات و كما يمكنك تعديلها و حذفها الى سلة المحذوفات و تعرف ماذا صوت الاعضاء.</p>
<p><br />