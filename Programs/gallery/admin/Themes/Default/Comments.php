<!-- comment table start -->
<table style="width: 100%; border: 1px solid #AEC9FF;" cellspacing="0" cellpadding="0">
	<tr>
		<td style="width: 3px; height: 19px; ">&nbsp;
		</td>
		<td style="height: 19px; width: 16px; ">
		<img alt="" src="Programs/news/Themes/{ThemeName}/Images/say.gif" width="16" height="13" /></td>
		<td style="height: 19px; width: 90%;">		
		<!-- CommentTitle start-->
        <strong>
			{CommentTitle}        </strong>
		<!-- end of CommentTitle-->
        	<a href="{DeleteCmnt}" onclick="return AcceptDelCmnt();">
				<img src="Programs/gallery/admin/images/delete.png" border="0" width="13" height="13" alt="delete" />
            </a>
        </td>
	  <td style="height: 19px; width: 15px; direction: rtl; ">
		<!-- Nbr of Comment start -->
		{CN}
		<!-- end of Nbr of Comment start -->
		</td>
		<td style="width: 3px; height: 19px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 3px; height: 19px; ">&nbsp;</td>
		<td rowspan="2" colspan="3"">
		
		<!--begin of comments info table -->
		<table cellspacing="0" cellpadding="0" width="550px" >
			<tr>
				<td >
				<strong> <span lang="en-us">
				&nbsp;<!-- Author start -->{Author}
				<!-- end of Author -->
				&nbsp; </span></strong></td>
				<td>
				&nbsp;<!-- AuthorName start -->{AuthorName}
				<!-- end of AuthorName -->
				</td>
				<td><span lang="en-us"><strong>
				&nbsp;<!-- Contry start -->{Contry}
				<!-- end of Contry-->
				 &nbsp;</strong></span></td>
				<td>
				<!-- start of ContryName-->
				{ContryName}
				<!-- end of ContryName-->
				</td>
			</tr>
			<tr>
				<td><span lang="en-us"><strong>
				&nbsp;<!-- email start -->{email}
				<!-- end of email-->
				 &nbsp;</strong></span></td>
				<td>
				&nbsp;<!-- emailAddress start -->{emailAddress}
				<!-- end of emailAddress-->
				</td>
				<td><span lang="en-us"><strong>
				&nbsp;<!-- Date start -->{Date}
				<!-- end of Date -->
				 &nbsp;</strong></span></td>
				<td valign="top">
				&nbsp;<!-- CommentDate start -->{CommentDate}
				<!-- end of CommentDate -->
				</td>
			</tr>
		</table>
			<!--end of comments info table -->
		</td>
		<td style="width: 3px; height: 19px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 3px; height: 19px;">&nbsp;</td>
		<td style="width: 3px; height: 19px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 3px; height: 0; ">&nbsp;</td>
		<td style="height: 0; border: thin #AEC9FF dashed;" colspan="3" valign="top">
		<!-- theComment start -->
		{theComment}
		<!-- end of theComment -->
		</td>
		<td style="width: 3px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 3px; height: 3px;">
		<img alt="" src="Programs/news/Themes/{ThemeName}/Images/spacer.gif" width="1" height="1" /></td>
		<td style="height: 3px;" colspan="3; ">
		<img alt="" src="Programs/news/Themes/{ThemeName}/Images/spacer.gif" width="1" height="1" /></td>
		<td style="width: 3px; height: 3px;">
		<img alt="" src="Programs/news/Themes/{ThemeName}/Images/spacer.gif" width="1" height="1" /></td>
	</tr>
</table> <!-- end of comment table -->