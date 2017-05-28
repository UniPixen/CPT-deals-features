I am making a custom post plugin for my blog.. I'm new in creating plugin, so I need a little help from you.

What my plugin CPT(Custom Post Type) does...
I have CPT-1 "Features" just like Features by WooThemes & also CPT-2 "Deals" which has a META box which automatically loads all the post from "features" as CheckBox.

What I want is:-

When I create a new post in "deals" I want to assign the deals to have certain features. The features (i.e: checkbox) is saved as META_KEY & META_VALUE for each post(deals).

The Problem is: I am able to load all the features post into the MetaBox in deals. but I am unable to save/update using update_post_meta.

Where the problem is: The checkbox's name field is dynamic. " type="checkbox" value="true"> //$queryFTID echos meta100, where meta is static word and number is post id.

what i want is to have $queryFTID as foreach and save into array. so that i can save/update meta fields for each post_id.

here is the save/update code Here is my code below:
