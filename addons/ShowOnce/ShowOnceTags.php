<?php

namespace Statamic\Addons\ShowOnce;

use Statamic\API\User;
use Statamic\Extend\Tags;

class ShowOnceTags extends Tags
{
    /**
     * The {{ show_once }} tag
     *
     * @return string|array
     */
    public function index()
    {
        $code = $this->get('code');
        
        // if no code then do nothing and show everything;
        if (!$code)
        {
        	return $this->parse([]);;
        }
        
        // if logged in check to see if they've seen this before
        if ($user = User::getCurrent())
        {
        	$id = $user->get('id');
        	
        	// get the record, if it exists
            $record = $this->cache->get($id);
            
            // if they've seen it
            if (isset($record[$code]))
            {
            	// don't show anything
            	return;
            }
            else
            {
            	// if there's no record, we have to create it
            	if (!$record)
            	{
            		$record = array();
				}
				
				// add the time they saw it
				$record[$code] = time();

				// record it
				$this->cache->put($id, $record);

            	// show it
            	return $this->parse([]);
            }
        }
        else
        {	// if they're not logged in, use a cookie
        	$key = $this->getAddonClassName() . '_' . $code;
        	
        	// get the cookie
        	$cookie = $this->cookie->get($key);
        	
        	// if there's no cookie, it means they've never seen it
        	if (!$cookie)
        	{
        		// they're going to see it, so create the cookie
        		$this->cookie->put($key, time());
        		
        		// show it
    			return $this->parse([]);
        	}
        }       
    }
}