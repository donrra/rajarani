<%@  Language=vbscript %>
<%
 Response.Expires = 0
 Response.Expiresabsolute = Now() - 1 
 Response.AddHeader "pragma","no-cache" 
 Response.AddHeader "cache-control","private" 
 Response.CacheControl = "no-cache" 

' Server.Execute("/_includes/autologoff.asp")
' Server.Execute("/_includes/autologon.asp")
' Server.Execute("/_includes/autologging.asp")

NoSecret = True

 Function DoRequest(obj)
  DoRequest = mySmartUpload.Form(obj)
 End Function

%>
<!--#INCLUDE VIRTUAL="/_includes/config.asp"-->
<!--#INCLUDE VIRTUAL="/_includes/functions_lite.asp"-->
<%
' If InStr(Request.QueryString, "AddPict")>0 Then

 Dim mySmartUpload
 Set mySmartUpload = Server.CreateObject("aspSmartUpload.SmartUpload")
 mySmartUpload.AllowedFilesList = "jpg,jpeg"
 mySmartUpload.DenyPhysicalPath = True
 mySmartUpload.MaxFileSize = 150000
 mySmartUpload.Upload

 Dim i
 i=0

 PictureFolder		= "/_pictures/"
 SavePicsForDays	= 14

 rqSetPrimary		= DoRequest("SetPrimary")
 rqPictureRestrictions	= DoRequest("PictureRestrictions")

 rqMailBox = DoRequest("MB")
 If (rqMailBox <> "" And Session("MemberId") = "1") Then	'later to be admin
  MailBox = rqMailBox
 Else
  rqMailbox = ""
  MailBox = Session("MemberId")
 End If

 OpenConn(Conn)

 If rqSetPrimary <> "" And IsNumeric(rqSetPrimary) And False Then	'Need PictSortOrder In DB...
  strSQL = "SELECT * From profiles_pictures Where UserId=" & make2mysqlS(Mailbox) & " Order By PictSortOrder"
  Set Rs = Conn.Execute(strSQL)
  If Not Rs.Eof Then
   i = 1
   Do Until Rs.Eof Or i > 3
    RsPictNum = Rs("PictNum")
    If RsPictNum = CInt(rqSetPrimary) Then
     Conn.Execute("UPDATE profiles_pictures Set PictSortOrder='0' Where UserId=" & make2mysqlS(Mailbox) & " And PictNum=" & make2mysqlS(i))
    Else
     Conn.Execute("UPDATE profiles_pictures Set PictSortOrder=" & make2mysqlS(i) & " Where UserId=" & make2mysqlS(Mailbox) & " And PictNum=" & make2mysqlS(i))
     i = i + 1
    End If

    Rs.MoveNext
   Loop
  End If
  Set Rs = Nothing
 End If

 'PictureRestrictions / ProfileShowPicture
 '0 - Indtil videre må ingen se mine billeder
 '1 - Kun dem jeg giver lov til at kontakte mig
 '2 - Alle

' If rqPictureRestrictions <> "" Then
'  Conn.Execute("UPDATE profiles_users Set ProfileShowPicture=" & make2mysql(rqPictureRestrictions) & " Where ProfileId=" & make2mysqlS(Mailbox))
'  PictureRestrictions = rqPictureRestrictions
' Else
'  strSQL = "SELECT * FROM profiles_users Where ProfileId=" & make2mysqlS(Mailbox)
'  Set Rs = Conn.Execute(strSQL)

'  If Not Rs.Eof Then
'   PictureRestrictions	= Rs("PictureRestrictions")
'  End If
' End If
' If PictureRestrictions = "" Then PictureRestrictions = 0

 If rqPictureRestrictions <> "" Then
  Conn.Execute("UPDATE profiles_users Set ProfileShowPicture=" & make2mysqlS(rqPictureRestrictions) & " Where ProfileId=" & make2mysqlS(Mailbox))
 End If

 MinimumNumberOfPictures = 3
 strFileFieldPrefix = "FILE"	'Example: "FILE_#", Where # is any number....
 For i=1 To MinimumNumberOfPictures
  strFieldName = strFileFieldPrefix & i

  AvailableFields = ","
  For Each Fld In mySmartUpload.Files
   AvailableFields = AvailableFields & Fld.Name & ","
  Next

  If InStr(AvailableFields, ","&strFieldName&",")>0 Then	'ok field is there...
   Set File = mySmartUpload.Files(strFieldName)
   If Not File.IsMissing Then
    PictId = MailBox & CLng(Year(Date())+Month(Date())+Day(Date())+Hour(Time())+Minute(Time())+Second(Time())/2*3) & i & "." & LCase(File.FileExt)
    SaveAs = PictureFolder & PictId
    File.SaveAs(SaveAs)

    If Err = 0 Then
     strSQL = "SELECT '' As Something From profiles_pictures Where UserId=" & make2mysqlS(Mailbox) & " And PictNum=" & make2mysqlS(i)
     If Not False = Conn.Execute(strSQL).Eof Or SavePicsForDays > 0 Then
      If SavePicsForDays > 0 Then
       strSQL = "UPDATE profiles_pictures Set "&_
       "PictDteDeleted="	& "Now()"&_
       " Where UserId="	& make2mysqlS(Mailbox)&_
       " And PictNum="	& make2mysqlS(i)&_
       " And PictDteDeleted="	& make2mysqlS("0000-00-00 00:00:00")	'End SQL
       Conn.Execute(strSQL)
      End If

      'Insert
      strSQL = "INSERT INTO profiles_pictures ("&_
      "UserId"&_
      ", PictPath"&_
      ", PictDate"&_
      ", PictNum"&_
      ") VALUES ("&_
      ""		& make2mysqlS(MailBox)&_
      ", "		& make2mysqlS(PictId)&_
      ", "		& "Now()"&_
      ", "		& make2mysqlS(i)&_
      ")"	'End SQL
     Else
      If SavePicsForDays = 0 Then
       'Update / Replace
       strSQL = "UPDATE profiles_pictures Set "&_
       "PictPath="	& make2mysqlS(PictId)&_
       " Where UserId="	& make2mysqlS(Mailbox)&_
       " And PictNum="	& make2mysqlS(i)	'End SQL
      End If
     End If
     If strSQL <> "" Then Conn.Execute(strSQL)
    End If
   End If
  End If
 Next
 Set File = Nothing

 CloseConn(Conn)
' Response.Redirect "epimage.asp"
 Response.Redirect "/editprofile.asp?cmd=pict"
%>