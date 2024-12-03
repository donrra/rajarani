<%@  Language=vbscript %>
<%
 Response.Expires = 0
 Response.Expiresabsolute = Now() - 1 
 Response.AddHeader "pragma","no-cache" 
 Response.AddHeader "cache-control","private" 
 Response.CacheControl = "no-cache" 
%>
<!--#INCLUDE VIRTUAL="/_includes/config.asp"-->
<!--#INCLUDE VIRTUAL="/_includes/functions.asp"-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Rajarani</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/_styles/main.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="E4CBAC" topmargin="0">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="1" rowspan="6" bgcolor="#FFFFFF"><img src="/images/onepix.gif" width="1" height="1"></td>
    <td><img src="/images/top.gif" width="798" height="76"></td>
    <td width="1" rowspan="6" bgcolor="#FFFFFF"><img src="/images/onepix.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td height="18" background="/images/back_menu.jpg"><table width="542" height="18" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td ><img src="/images/pusher_menu.gif" width="81" height="18"></td>
          <td width="461"><a href="start.asp">FORSIDE</a><a href="index.asp">&nbsp;&nbsp;&nbsp;&nbsp;PROFIL 
            &amp; MEDLEMSKAB&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="index.asp">om 
            rajarani</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><img src="/images/bottom_top2.gif" width="798" height="72"></td>
  </tr>
  <tr> 
    <td valign="top" background="/images/back_content.gif" bgcolor="#FAE1C2"><table width="798" height="181" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="159" align="center" valign="top"><table width="127" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td></td>
                <td><img src="/images/submenu-tops.gif" width="127" height="4"></td>
                <td></td>
              </tr>
              <tr bgcolor="C2AC91"> 
                <td height="21" colspan="3" class="head_submenu">Services</td>
              </tr>
              <tr> 
                <td width="1"  bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
                <td  height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">søg 
                  partner</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="1" bgcolor="C2AC91"><img src="/images/onepix.gif" width="1" height="1"></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">Match 
                  profil</a></td>
                <td bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="1" bgcolor="C2AC91"><img src="/images/onepix.gif" width="1" height="1"></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td></td>
                <td height="5"></td>
                <td></td>
              </tr>
              <tr> 
                <td></td>
                <td height="4"><img src="/images/submenu-tops.gif" width="127" height="4"></td>
                <td></td>
              </tr>
              <tr bgcolor="c2ac91"> 
                <td height="21" colspan="3" class="head_submenu">Post</td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">indbakke</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="1" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">kladder</a></td>
                <td bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">papirkurv</a></td>
                <td bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="1" bgcolor="C2AC91"><img src="/images/onepix.gif" width="1" height="1"></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td></td>
                <td height="5"></td>
                <td></td>
              </tr>
              <tr> 
                <td></td>
                <td><img src="/images/submenu-tops.gif" width="127" height="4"></td>
                <td></td>
              </tr>
              <tr bgcolor="c2ac91"> 
                <td height="21" colspan="3" class="head_submenu">Min 
                  profil</td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">Rediger 
                  profil</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">min 
                  præsentation</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">min 
                  oplysninger</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">om 
                  min medlemskab</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">ændre 
                  adgangskode</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
              <tr> 
                <td bgcolor="C2AC91"></td>
                <td height="22" bgcolor="FAE1C2">&nbsp;<a href="index.asp" class="link_submenu">log 
                  af</a></td>
                <td bgcolor="C2AC91"></td>
              </tr>
              <tr> 
                <td height="1" colspan="3" bgcolor="C2AC91"><img src="/images/onepix.gif"></td>
              </tr>
            </table>
            <br><br> <br><br> <br>
            <td width="479" valign="top" class="text"><table width="419" border="0" align="center" cellpadding="0" cellspacing="0" height="752">
              <tr> 
                <td width="14" height="30" class="text"></td>
                <td width="405" class="text" height="30"></td>
              </tr>
              <tr> 
                <td width="14" height="120" class="text"></td>
                <td width="405" class="text" height="120"><strong>Billeder</strong><br>
                  Undersøgelser viser at du kan få forhøjet andres interesse for&nbsp; 
				med op til 70%! Indsæt op til 3 
				billeder<p>Bemærk at alle billeder vil blive screenet og hvis de 
				indeholder anstødeligt materiale, eller billeder af andre vil de 
				blive fjernet af rajarani.dk<p><b>Du kan indsætte .gif eller .jpg
                  billeder af max. 300 kb.&nbsp;</b></td>
              </tr>
             <form method="POST" enctype="multipart/form-data" action="picturecontrol.asp">
              <tr valign="top"> 
                <td height="602" colspan="2">
				<table width="413" height="185" border="0" cellpadding="0" cellspacing="0" class="text">
                    <tr> 
                      <td width="411" height="139" valign="top">
                        <div align="center">
                          <center>
			<table width="385" border="0" cellspacing="0" cellpadding="0" class="text" height="60">
                          <tr> 
                            <td height="1" bgcolor="#FAE1C2" width="10"></td>
                            <td width="125" bgcolor="#FAE1C2" height="1">&nbsp;</td>
                            <td height="1" bgcolor="#FAE1C2" width="1"></td>
                            <td height="1" bgcolor="#FAE1C2" width="125"></td>
                            <td height="1" bgcolor="#FAE1C2" width="1"></td>
                            <td height="1" bgcolor="#FAE1C2" width="125"></td>
                          </tr>
<%
 Dim ArrPictures(2)

 OpenConn(Conn)
 strSQL = "SELECT PictPath, PictNum From profiles_pictures Where UserId=" & make2mysqlS(Session("MemberId")) & " And PictDteDeleted='000-00-00 00:00:00' Order By PictNum Asc"
' Response.Write strSQL
 Set Rs = Conn.Execute(strSQL)

 If Not Rs.Eof Then
  Do Until Rs.Eof
   RsPictNum	= Rs("PictNum")
   RsPictPath	= Rs("PictPath")
   If RsPictNum <= Ubound(ArrPictures)+1 Then
    ArrPictures(RsPictNum-1) = RsPictPath
   End If
   Rs.MoveNext
  Loop
 End If

 strSQL = "SELECT ProfileShowPicture FROM profiles_users Where ProfileId=" & make2mysqlS(Session("MemberId"))
 Set Rs = Conn.Execute(strSQL)

 If Not Rs.Eof Then
  PictureRestrictions	= Rs("ProfileShowPicture")
 End If
 If PictureRestrictions = "" Then PictureRestrictions = 0

 Set Rs = Nothing
 CloseConn(Conn)
%>
                          <tr> 
                            <td height="69" bgcolor="#FAE1C2" width="10"></td>
                            <td height="69" bgcolor="#FAE1C2" width="125" align="center"><img src="/dothumb.asp?Pict=<%=ArrPictures(1-1)%>" awidth="125" aheight="122"></td>
                            <td height="69" bgcolor="#FAE1C2" width="1">&nbsp;</td>
                            <td height="69" bgcolor="#FAE1C2" width="125" align="center"><img src="/dothumb.asp?Pict=<%=ArrPictures(2-1)%>" awidth="125" aheight="122"></td>
                            <td height="69" bgcolor="#FAE1C2" width="1">&nbsp;</td>
                            <td height="69" bgcolor="#FAE1C2" width="125" align="center"><img src="/dothumb.asp?Pict=<%=ArrPictures(3-1)%>" awidth="125" aheight="122"></td>
                          </tr>
                          <tr> 
                            <td height="1" bgcolor="#FAE1C2" width="4"></td>
                            <td width="125" class="text" bgcolor="E4CBAC" height="20">
							<p align="center"><b>Billede 1</b></td>
                            <td height="20" bgcolor="#FAE1C2" width="1" class="text">&nbsp;</td>
                            <td height="20" bgcolor="#E4CBAC" width="125" align="center" class="text">
                            <b>Billede 2</b></td>
                            <td height="20" bgcolor="#FAE1C2" width="1" align="center" class="text">&nbsp;</td>
                            <td height="20" bgcolor="#E4CBAC" width="125" align="center" class="text">
                            <b>Billede 3</b></td>
                          </tr>
                          </table></center>
                        </div>
                      </td>
                    </tr>
                    <tr> 
                      <td height="24" width="411"></td>
                    </tr>
                    <tr> 
                      <td width="411">
						<div align="center">
							<table width="377" border="0" cellspacing="0" cellpadding="0" class="text" height="355">
                          <tr> 
                            <td height="22" bgcolor="C2AC91" width="7">&nbsp;</td>
                            <td width="279" height="22" bgcolor="C2AC91" class="head_submenu" colspan="3"><b>1.
                              Vælg billede</b></td>
                            <td width="75" align="center" bgcolor="C2AC91" class="head_submenu" height="22">
							Status</td>
                          </tr>
                          <tr> 
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr> 
                            <td bgcolor="E4CBAC" width="7" height="26">&nbsp;</td>
                            <td height="26" bgcolor="E4CBAC" class="text" width="69"><b>Billede 1</b></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="228" colspan="2"><input type="file" name="FILE1" size="20" class="input_box"></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="81"><b>Aktiv</b></td>
                          </tr>
                          <tr> 
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr>
                            <td height="21" width="7">&nbsp;&nbsp;</td>
                            <td colspan="4" height="21" width="382">Billede 1
                              vises, når andre læser din profil</td>
                          </tr>
                          <tr> 
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr> 
                            <td bgcolor="E4CBAC" width="7" height="26">&nbsp;</td>
                            <td height="26" bgcolor="E4CBAC" class="text" width="69"><b>Billede
                              2</b></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="228" colspan="2"><input type="file" name="FILE2" size="20" class="input_box"></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="81"><b>Fri</b></td>
                          </tr>
                          <tr> 
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr> 
                            <td bgcolor="E4CBAC" width="7" height="26">&nbsp;</td>
                            <td height="26" bgcolor="E4CBAC" class="text" width="69" ><b>Billede
                              3</b></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="228" colspan="2"><input type="file" name="FILE3" size="20" class="input_box"></td>
                            <td align="center" bgcolor="E4CBAC" height="26" width="81"><b>Fri</b></td>
                          </tr>
                          <tr> 
                            <td bgcolor="#FAE1C2" width="7" height="20"></td>
                            <td height="1" bgcolor="#FAE1C2" width="69" ></td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="215">
							</td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="13">
							</td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="81"></td>
                          </tr>
                          <tr>
                            <td height="22" bgcolor="C2AC91" width="7">&nbsp;</td>
                            <td width="354" height="22" bgcolor="C2AC91" class="head_submenu" colspan="4"><b>2.
                              Synlighed - Hvem må se dine billeder?</b></td>
                          </tr>
                          <tr>
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr>
                            <td bgcolor="E4CBAC" width="7" height="2">&nbsp;</td>
                            <td height="2" bgcolor="E4CBAC" class="text" width="69" align="center"><p align="center"><input type="radio" value="2"<%=Bool2Txt("2"=PictureRestrictions, " checked", "")%> name="PictureRestrictions"></p></td>
                            <td align="center" bgcolor="E4CBAC" height="2" width="309" colspan="3"><p align="left">Alle</td>
                          </tr>
                          <tr>
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr>
                            <td bgcolor="E4CBAC" width="7" height="12">&nbsp;</td>
                            <td height="12" bgcolor="E4CBAC" class="text" width="69" align="center"><p align="center"><input type="radio" value="1"<%=Bool2Txt("1"=PictureRestrictions, " checked", "")%> name="PictureRestrictions"></p></td>
                            <td align="center" bgcolor="E4CBAC" height="12" width="309" colspan="3"><p align="left">Kun dem jeg giver lov til at kontakte mig</td>
                          </tr>
                          <tr>
                            <td height="1" colspan="5" width="406"></td>
                          </tr>
                          <tr>
                            <td bgcolor="E4CBAC" width="7" height="9">&nbsp;</td>
                            <td height="9" bgcolor="E4CBAC" class="text" width="69" align="center" ><p align="center"><input type="radio" value="0"<%=Bool2Txt("0"=PictureRestrictions, " checked", "")%> name="PictureRestrictions"></p></td>
                            <td align="center" bgcolor="E4CBAC" height="9" width="309" colspan="3"><p align="left">Indtil videre må ingen se mine billeder</td>
                          </tr>
                          <tr>
                            <td bgcolor="#FAE1C2" width="7" height="20"></td>
                            <td height="1" bgcolor="#FAE1C2" width="69" ></td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="215">
							</td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="13">
							</td>
                            <td align="center" bgcolor="#FAE1C2" height="20" width="81"><input type="image" border="0" src="/images/btn_ok.JPG" width="52" height="15"></td>
                          </tr>
                          <tr> 
                            <td bgcolor="#FAE1C2" colspan="5" height="20" width="406">
							&nbsp;</td>
                          </tr>
                        </table></div>
						</td>
                    </tr>
                  </table></td>
              </tr>
             </form>
            </table> 
          </td>
          <td width="160" align="center" valign="top"> <div align="left">
              <table width="161" height="108" border="0" cellpadding="0" cellspacing="0" class="text">
                <tr> 
                  <td height="27" colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="14" height="14" valign="top">&nbsp;</td>
                  <td width="147" height="21"><strong>Hurtig s&oslash;gning</strong></td>
                </tr>
                <tr bgcolor="C2AC91"> 
                  <td height="21">&nbsp;</td>
                  <td height="21" class="head_submenu">S&oslash;g efter</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td bgcolor="#FAE1C2"></td>
  </tr>
  <tr> 
    <td height="1" bgcolor="#FFFFFF"><img src="/images/onepix.gif" width="1" height="1"></td>
  </tr>
</table>
</body>
</html>