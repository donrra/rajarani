<%
  Dim fso
  Set fso = CreateObject("Scripting.FileSystemObject")

  PictPath = "121001."
     If fso.FileExists(Server.Mappath("/_pictures/" & 		PictPath)) Then	fso.DeleteFile(Server.Mappath("/_pictures/" & PictPath))

  PictPath = "121141."
     If fso.FileExists(Server.Mappath("/_pictures/" & 		PictPath)) Then	fso.DeleteFile(Server.Mappath("/_pictures/" & PictPath))

  PictPath = "121001"
     If fso.FileExists(Server.Mappath("/_pictures/" & 		PictPath)) Then	fso.DeleteFile(Server.Mappath("/_pictures/" & PictPath))

  PictPath = "121141"
     If fso.FileExists(Server.Mappath("/_pictures/" & 		PictPath)) Then	fso.DeleteFile(Server.Mappath("/_pictures/" & PictPath))

%>