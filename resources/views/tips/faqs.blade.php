<!DOCTYPE html>
<html lang="en">
    @extends('layout.header_nav')
    <body>
        <div class='dashboard-main-container'>
            @extends('layout.navbar')
            <div class='profile-header'>
                <h2>FAQ's</h2>
            </div>
            <form class="search-bar" action=''>
                <input type="text" placeholder='Search for a question'>
                <p>Search for: <span>Lorem, ipsum.</span></p>
            </form>
            <div class='faqs-container'>
                <ol>
                    <li>
                        <h3>How is it?</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis, illo!</p>
                    </li>
                    <li>
                        <h3>How is it?</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis, illo!</p>
                    </li>
                    <li>
                        <h3>How is it?</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis, illo!</p>
                    </li>
                </ol>
            </div>    
        </div>
    </body>
</html>