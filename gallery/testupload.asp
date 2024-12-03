<%
 If InStr(Request.QueryString, "AddPict")>0 Then

  Set mySmartUpload = Server.CreateObject("aspSmartUpload.SmartUpload")

  mySmartUpload.AllowedFilesList = "jpg,jpeg"
  mySmartUpload.DenyPhysicalPath = True

  mySmartUpload.Upload

'  Response.Write mySmartUpload.Files.item(0).Name
  Response.Write mySmartUpload.Files.count


  PictureFolder = "/_pictures/"

'  i = 0
'  For each File In mySmartUpload.Files

'  '  Only if the file exist
'  '  **********************
'     If not file.IsMissing Then

'      i = i + 1
'      PictId = MailBox & CLng(Year(Date())+Month(Date())+Day(Date())+Hour(Time())+Minute(Time())+Second(Time())/2*3) & i & "." & LCase(File.FileExt)

'      SaveAs = PictureFolder & PictId
'      File.SaveAs(SaveAs)


'        intCount = intCount + 1
''      Response.Write "<img src=""/dothumb.asp?Pict=" & PictId & """><br />"
'     End If
'  Next

'  CloseConn(Conn)

 End If
%>
<FORM name="uploadform" METHOD="POST" ACTION="testupload.asp?AddPict" ENCTYPE="multipart/form-data">
<INPUT TYPE="FILE" NAME="FILE1" SIZE="30" accept="image/jpeg; image/tiff"><font id="FILE1_STATUS" color="#FFFFFF" SIZE="4">•</font>
<input type="submit">
</FORM>