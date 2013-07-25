Blog using CakePHP
==================

Note: The blog is developed using CAKEPHP 2.2.2 in Ubuntu OS   
      Environment.

  1. The blog is publicly viewable. 
  2. The blog is updated by a blog Owner. 


      There are three users named by super admin, admin and author. 

		a. Super Admin : 
			    There is only one super admin with userid=1.
			    Got all permission plus role setting for both author and admin.

		b. Admin:  
			    There may be more than one admin.
			    Got all the permission but role setting only for authors . 

		c. Author : 
			    Got only  permission to add post and comments for all the post. Author can 
		    	    edit/delete his own post. The new registered users are treated as author. 

  3. We can login as Super Admin, Admin, and Auther

  4. Registration form is created. 
	    Email address and username are unique. 8 Digit phone number is validated. Username limit 3 to 15 characters.Password/confirm password is checked and password need at least 5 characters and one numeric is must.  

  5. Only Registered users can post comment. They can comment  
     for any post in the blog. This is stored in database in table named as ‘comments’ which contains the fields:  id 
     (comment id-primary key), title (comment title), desc (comment description), blog_id (indicates comment from  
     which post), user_id (user who comment) and created (date/
     time the comment is posted) , where blog_id,  user_id are the foreign keys. So if you want to delete the blog post or user details, you must delete all the comments first  followed by the post and user.

  6.  Show number of comments for each entry 
  7.  Show date of each entry
  8.  Show the Title and part of the Body 

  		It will also shown the name of the owner of each post and name  of the person who login at that time. 

  9.  Admin can Edit/delete for all users (Author). Author can 
      Edit/delete his own post. 
  10. Associated Comments appears here. 
  11. Post a Comment form appears here.
  12. Each blog entry can have multiple comments by other Users
  13. features 
  		a. Sorting options: Blog post is sorted by asc/desc on 
  		   title, content and date using ajax
		b. User registration: Done 
		c. Interactive User Interfaces: Done 
		d. Pagination: Ajax pagination is Done 