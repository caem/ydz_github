<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
	<meta charset="UTF-8" />
	<title>阅读志</title>
	<link rel="stylesheet" type="text/css" media="screen"  href="/css/style.css" />
</head>
<body>
	<div class="topWrapper">
		<div class="top" >			
			<div id="logo" class="fl"><a href="#"><span class="logo">阅</span></a>读志</div>
			<div id="navigation">
				<ul>
					<li><a href="#" class="top">首页</a></li>
					<li><a href="#" class="top">miaoever</a></li>
					<li><a href="#" class="top">设置</a></li>
					<li><a href="#" class="top">登出</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="mainWrapper">
		<div id="main">
			<div id="sidebar"></div>
			<div id="rightbar">
				<div class="box">
					<div class="cell">
						<img src="/img/userhead.png" alt="miaoever" class="fl headimg" />
						<div class="sep5"></div>
						<span  style="margin:10px;margin-left: 10px;padding-left: 10px;font-weight: bold;">miaoever<div class="sep10"></div></span>
						<div class="sep5" style="clear:left"></div>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tbody>
								<tr>
									<td width="33%" align="center"><a href="/my/nodes" class="dark" style="display: block;">2<div class="sep3"></div><span class="fade">笔记总数</span></a></td>
									<td width="34%" style="border-left: 1px solid rgba(100, 100, 100, 0.4); border-right: 1px solid rgba(100, 100, 100, 0.4);" align="center"><a href="/my/topics" class="dark" style="display: block;">15<div class="sep3"></div>阅读总数</a></td>
									<td width="33%" align="center"><a href="/my/following" class="dark" style="display: block;">0<div class="sep3"></div><span class="fade">收藏</span></a></td>
								</tr>
							</tbody>
						</table>
						
					</div>
				</div>
				<div class="sep20"></div>
				<div class="box">
					<div class="cell">						
						<label>标签云</label>
					</div>
					<div class="inner" style="line-height: 2.5em;">
						<a class="cloudtag">心理学</a>
						<a class="cloudtag">价值观</a>
						<a class="cloudtag">理想</a>
						<a class="cloudtag">商业模式</a>
						<a class="cloudtag">成功</a>
						<a class="cloudtag">读书</a>
						<a class="cloudtag">经济学原理</a>
					</div>
				</div>
				<div class="sep20"></div>
				<div class="box">
					<div class="cell">
						<label>最近阅读</label>
					</div>
					<div class="inner latest">
						<ul>
							<li><a href="#">Unix环境高级编程</a></li>
							<li><a href="#">Head First 设计模式</a></li>
							<li><a href="#">精通CSS:高级web标准解决方案</a></li>
							<li><a href="#">黑客与画家</a></li>
							
						</ul>
					</div>
				</div>
			</div>
			<div id="content">
				<div class="box">
					<div class="cell">
						<span class="booktitle leftout"><?php $note[0]['book_title'] ?></span>					
						<div class="bookinfo">	
							<div class="sep10"></div>
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tbody>
									<tr width="230" >
										<td>
											<ul style="padding-left:0px;">
												<li title="作者: W.Richard Stevens / Stephen A.Rago"><span>作者</span> W.Richard Stevens / Stephen A.Rago</li>
												<li><span>ISBN</span> 9787115147318</li>
												<li><span>出版社</span> 人民邮电出版社</li>
												<li><span>页数</span> 780页</li>										
											</ul>
										</td>
										<td>
											<ul style="padding-left:0px;">
												<li><!--<img alt="开始时间" src="./img/ico_flag.png"  align="absbottom" border="0"/>--><span> 开始阅读</span> 2012-2-12</li>
												<li><!--img alt="结束时间" src="./img/ico_cup.png" />--><span>预计天数</span> 2周</li>
												<li><!--<img alt="当前进度" src="./img/ico_clock.png" />&nbsp;--><span>已读天数</span> 8天</li>
												<li><!--<img alt="笔记总数" src="./img/ico_archive.png" />--><span>笔记总数</span> 32条</li>									
											</ul>
										</td>
										<td>
											<div class="bookcover">
												<img alt="cover" src="/img/bookcover.jpg" />
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="blank"></div>
					</div>
				</div>
					<div class="sep20"></div>
				<div class="box">
					<div class="cell" style="margin-top: 5px;">
						<label>添加笔记</label>
						<div class="sep15"></div>
						<div class="pages"> 
							<img alt="页码" src="/img/ico_mark.png" />
							<span style="letter-spacing: 3px;">页码:&nbsp;第</span>
							<input type="text" style="width: 30px;height: 14px;"/>
							<span style="letter-spacing: 3px;">页</span>
						</div>
						<div class="sep10"></div>
						<textarea name="content" class="large-textarea" ></textarea>
						<div class="sep10"></div>
						<input type="submit" name="submit" value="写好了" class="button fr"></input>
						<div class="tag">
							<img alt="标签" src="/img/ico_tag.png" />
							<span style="letter-spacing: 3px;">标签:</span>
							<input type="text" style="width: 230px;height: 14px;display:inline;"/>
	
						</div>
						<div class="sep5"></div>
					</div>
					<div class="cell" style="margin-top: 5px;border-bottom:0px;">
						<label>阅读笔记</label>
					</div>
					<div class="cell" >				
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tbody>
								<tr>
									<td svalign="top">
										<a href="#">
											<img src="/img/userhead.png"  style="border:0px;"alt="">
										</a>
									<td>
									<td width="10"></td>
									<td width="auto" valign="top">
										<div class="sep3"></div>
										<strong>
											<a href="#">miaoever</a>
										</strong>
										<div class="sep10"></div>
										<div class="content" >
											在信号一章，许多的语句需要字句斟酌，一字一字研读，如果某部分有疑问，翻看英文版，多半都能得到解决。这本书的前部分，译者做得很不错，但是，中文毕竟还是翻译过来的，用词的准确性比不上英文原版。
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="sep10"></div>
						<div class="tagPanel">
									<a href="#" class="small-tag">Nginx</a>
									<a href="#" class="small-tag">价值观</a>
									<a href="#" class="small-tag">理想</a>
						</div>
					</div>
					<div class="cell">		

							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tbody>
								<tr>
									<td valign="top">
										<a href="#">
											<img src="/img/userhead.png"  style="border:0px;"alt="">
										</a>
									<td>
									<td width="10"></td>
									<td width="auto" valign="top">
										<div class="sep3"></div>
										<strong>
											<a href="#">miaoever</a>
										</strong>
										<div class="sep10"></div>
										<div class="content" >
											在信号一章，许多的语句需要字句斟酌，一字一字研读，如果某部分有疑问，翻看英文版，多半都能得到解决。这本书的前部分，译者做得很不错，但是，中文毕竟还是翻译过来的，用词的准确性比不上英文原版。
										</div>
									</td>
								</tr>
								</tbody>
							</table>
							<div class="sep10"></div>
							<div class="tagPanel">
								<a href="#" class="small-tag">Nginx</a>
								<a href="#" class="small-tag">价值观</a>
								<a href="#" class="small-tag">理想</a>
								<a href="#" class="small-tag">Python</a>
								<a href="#" class="small-tag">PHP</a>
							</div>
							<div class="sep10"></div>
					</div>
				</div>	
					
				</div>
			</div>
		
	</div>
</body>
</html>
