<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
</HEAD>
<BODY BGCOLOR="white">
<H1>aspSmartUpload : Sample 8</H1>
<HR>

<%
'  Variables
'  *********
   Dim mySmartUpload
   Dim intCount
        
'  Object creation
'  ***************
   Set mySmartUpload = Server.CreateObject("aspSmartUpload.SmartUpload")

'  Upload
'  ******
'   mySmartUpload.CodePage = "utf-8"
   mySmartUpload.Upload

   Response.Write "Text : "
   Response.Write mySmartUpload.Form("TEXT1").values & "<br>"

   Response.Write "File : "
   Response.Write mySmartUpload.Files("FILE1").Filename & "<br>"

MailBox = Session("MemberName")
If MailBox = "" Then MailBox = 1
i=0

PictureFolder = "/_pictures/"

      i = i + 1
      Set File = mySmartUpload.Files("FILE1")
      PictId = MailBox & CLng(Year(Date())+Month(Date())+Day(Date())+Hour(Time())+Minute(Time())+Second(Time())/2*3) & i & "." & LCase(File.FileExt)
      SaveAs = PictureFolder & PictId
      File.SaveAs(SaveAs)
'   intCount = mySmartUpload.Save("/_pictures")

Response.Write "File.IsMissing" & File.IsMissing

%>
</BODY>
</HTML> 
