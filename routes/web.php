<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubManagerController;
use App\Http\Controllers\ClubMemberController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\GroundController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\PlayerCategoriesController;
use App\Http\Controllers\PlayerMatchDetails;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamPlayerController;
use App\Http\Controllers\UserController;
use App\Models\ClubManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
Route::get('/', [FrontPageController::class, 'index'])->name('home');

Route::get('logout', [ClubManagerController::class, 'logout'])->name('club.logout');
Route::get('login', [ClubManagerController::class, 'login'])->name('club.login');
Route::post('login', [ClubManagerController::class, 'loginAuth'])->name('club.login');

Route::get('viewEvent/{id}', [FrontPageController::class, 'viewEvent'])->name('viewEvent');
Route::get('viewAllEvents', [FrontPageController::class, 'viewAllEvents'])->name('viewAllEvents');
Route::get('contact-us', [FrontPageController::class, 'contact'])->name('contact-us');

Route::get('userLogin', [UserController::class, 'login'])->name('user.login');
Route::post('userLogin', [UserController::class, 'loginAuth'])->name('user.login');

Route::get('user_dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
Route::group(['middleware'=>'clubManager'], function(){
});

//Club Manager Routes
Route::group(['middleware'=>'clubManager'], function(){
Route::get('dashboard', [FrontPageController::class, 'dashboard'])->name('dashboard');

// Club Members Routes 
Route::get('clubMembers', [ClubManagerController::class, 'clubMembers'])->name('clubMembers');
Route::post('clubMembers', [ClubManagerController::class, 'addMember'])->name('clubMembers');
Route::get('clubMembers/edit/{id}', [ClubManagerController::class, 'editClubMember'])->name('editClubMember');
Route::post('clubMembers/update/{id}', [ClubManagerController::class, 'updateClubMember'])->name('updateClubMember');
Route::get('clubMembers/delete/{id}', [ClubManagerController::class, 'deleteClubMember'])->name('deleteClubMember');

// Club Teams Routes 
Route::get('teams', [ClubManagerController::class, 'myTeams'])->name('clubTeams');
Route::post('teams', [ClubManagerController::class, 'addTeam'])->name('addClubTeam');
Route::get('team/edit/{id}', [ClubManagerController::class, 'editTeam'])->name('editClubTeam');
Route::post('team/update/{id}', [ClubManagerController::class, 'updateTeam'])->name('updateClubTeam');
Route::get('team/delete/{id}', [ClubManagerController::class, 'deleteTeam'])->name('deleteClubTeam');

//Club Team Members Routes
Route::get('club/teamMembers/{teamid}/{clubid}', [TeamPlayerController::class, 'club_teamMembers'])->name('club_teamMembers');
Route::post('club/clubMembers/get_member_by_category_id', [TeamPlayerController::class, 'get_member_by_category_id'])->name('get_member_by_category_id_for_club');
Route::post('club/clubMembers/add_new_teamMember', [TeamPlayerController::class, 'add_new_teamMember'])->name('admin_add_new_teamMember_for_club');
Route::get('club/teamMember/delete/{id}', [TeamPlayerController::class, 'delete_teamMember'])->name('delete_teamMember');

//Club Coaches Routes
Route::get('coaches', [ClubManagerController::class, 'clubCoaches'])->name('clubCoaches');
Route::post('coaches', [ClubManagerController::class, 'addClubCoach'])->name('addClubCoach');
Route::get('coach/edit/{id}', [ClubManagerController::class, 'editClubCoach'])->name('editClubCoach');
Route::post('coach/update/{id}', [ClubManagerController::class, 'updateClubCoach'])->name('updateClubCoach');
Route::get('coach/delete/{id}', [ClubManagerController::class, 'deleteClubCoach'])->name('deleteClubCoach');

//Club Coaches Routes
Route::get('myEvents/{type}', [ClubManagerController::class, 'clubEvents'])->name('clubEvents');
Route::post('myEvents/{type}', [ClubManagerController::class, 'addClubEvent'])->name('addClubEvent');
Route::get('myEvents/editEvent/{id}', [ClubManagerController::class, 'editClubEvent'])->name('editClubEvent');
Route::post('myEvents/updateEvent/{id}', [ClubManagerController::class, 'updateClubEvent'])->name('updateClubEvent');
Route::get('myEvents/deleteEvent/{id}', [ClubManagerController::class, 'deleteClubEvent'])->name('deleteClubEvent');


// Club Profile Routes
Route::get('profile', [FrontPageController::class, 'profile'])->name('profile');
Route::get('profile/edit/{id}', [FrontPageController::class, 'editProfile'])->name('editProfile');
Route::post('profile/update/{id}', [FrontPageController::class, 'updateProfile'])->name('updateProfile');

//Mathches Routes 
Route::get('clubMatches', [MatchesController::class, 'clubMatches'])->name('clubMatches');
Route::post('sendNewMatchRequest', [MatchesController::class, 'sendNewMatchRequest'])->name('sendNewMatchRequest');
Route::get('matchDetails/{requestID}', [MatchesController::class, 'matchRequestPage'])->name('matchRequestPage');
Route::post('acceptRequest', [MatchesController::class, 'acceptRequest'])->name('acceptRequest');
//Player Match details
Route::get('addPlayerDetails/{playerid}/{matchid}', [PlayerMatchDetails::class, 'index'])->name('playerMatchDetails');
Route::post('storePlayerDetails/{playerid}/{matchid}', [PlayerMatchDetails::class, 'storePlayerDetails'])->name('storePlayerDetails');
Route::get('editPlayerDetails/{playerid}/{matchid}', [PlayerMatchDetails::class, 'editPlayerDetails'])->name('editPlayerDetails');
Route::post('updatePlayerDetails/{playerid}/{matchid}', [PlayerMatchDetails::class, 'updatePlayerDetails'])->name('updatePlayerDetails');

//Change Password Route
Route::get('changePassword', [FrontPageController::class, 'changePassword'])->name('changePassword');

});
//Club Manager Routes End


//Admin Routes
Route::group(['prefix'=>'admin'], function(){

    Route::group(['middleware'=>'admin.guest'], function(){
        Route::get('login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AdminController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware'=>'admin.auth'], function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.home');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        //Admin Ground Setup Routes
        Route::get('/grounds', [GroundController::class, 'index'])->name('admin.grounds');
        Route::post('/grounds', [GroundController::class, 'store'])->name('admin_add_new_ground');
        Route::get('/ground/editGround/{id}', [GroundController::class, 'edit'])->name('admin_edit_ground');
        Route::post('/ground/updateGround/{id}', [GroundController::class, 'update'])->name('admin_update_ground');
        Route::post('/ground/status_check/', [GroundController::class, 'ground_status_check'])->name('ground_status_check');
        Route::get('/ground/delete/{id}', [GroundController::class, 'delete'])->name('admin_delete_ground');

        //Admin Player Categrories Routes
        Route::get('player_categeries', [PlayerCategoriesController::class, 'index'])->name('admin.player_categories');
        Route::post('player_categories/store', [PlayerCategoriesController::class, 'store'])->name('admin_add_new_playerCategory');
        Route::post('player_categories/edit', [PlayerCategoriesController::class, 'edit'])->name('admin_edit_playerCategory');
        Route::post('player_categories/update', [PlayerCategoriesController::class, 'update'])->name('admin_update_playerCategory');
        Route::get('player_categories/delete/{id}', [PlayerCategoriesController::class, 'delete'])->name('admin_delete_playerCategory');

        //Clubs Routes 
        Route::get('clubs', [ClubController::class, 'index'])->name('admin.clubs');
        Route::post('clubs', [ClubController::class, 'store'])->name('admin_add_new_club');
        Route::get('club/editClub/{id}', [ClubController::class, 'edit'])->name('admin_edit_club');
        Route::post('club/updateClub/{id}', [ClubController::class, 'update'])->name('admin_update_club');
    
        //Club Members 
        Route::get('club/clubMembers/{id}', [ClubMemberController::class, 'index'])->name('admin.clubMembers');
        Route::post('club/clubMembers/store/{id}', [ClubMemberController::class, 'store'])->name('admin_add_club_members');
        Route::get('club/clubMembers/edit/{id}', [ClubMemberController::class, 'edit'])->name('admin_edit_club_members');
        Route::post('club/clubMembers/update/{id}', [ClubMemberController::class, 'update'])->name('admin_update_club_members');
        Route::get('club/clubMembers/delete/{id}', [ClubMemberController::class, 'delete'])->name('admin_delete_club_members');

        //Club Team Routes 
        Route::get('club/teams/{id}', [TeamController::class, 'index'])->name('admin.ClubTeam');
        Route::post('club/teams/store', [TeamController::class, 'store'])->name('admin_add_new_team');
        Route::get('club/editTeam/{id}', [TeamController::class, 'edit'])->name('admin_edit_team');
        Route::post('club/updateTeam/{id}', [TeamController::class, 'update'])->name('admin_update_team');
        Route::get('club/team/delete/{id}', [TeamController::class, 'delete'])->name('admin_update_team');
        
        //Club Team Member Routes
        Route::get('club/clubMembers/{team_id}/{club_id}', [TeamPlayerController::class, 'index'])->name('admin.TeamPlayers');
        Route::post('club/clubMembers/get_member_by_category_id', [TeamPlayerController::class, 'get_member_by_category_id'])->name('get_member_by_category_id');
        Route::post('club/clubMembers/add_new_teamMember', [TeamPlayerController::class, 'add_new_teamMember'])->name('admin_add_new_teamMember');
        Route::get('club/teamMember/delete/{id}', [TeamPlayerController::class, 'delete_teamMember'])->name('admin_delete_teamMember');
        
        //Admin Coach Routes
        Route::get('club/coaches/{clubid}', [CoachController::class, 'index'])->name('admin.coaches');
        Route::post('club/coaches/{clubid}', [CoachController::class, 'store'])->name('admin_add_new_coach');
        Route::get('club/editCoach/{coachid}', [CoachController::class, 'edit'])->name('admin_edit_coach');
        Route::post('club/editCoach/{coachid}', [CoachController::class, 'update'])->name('admin_update_coach');
        Route::get('club/deleteCoach/{coachid}', [CoachController::class, 'delete'])->name('admin_delete_coach');
        
        //Admin Events Routes
        Route::get('events', [EventController::class, 'index'])->name('admin.events');
        Route::post('events', [EventController::class, 'store'])->name('admin.addNewEvents');
        Route::get('events/editEvent/{id}', [EventController::class, 'edit'])->name('admin.editEvent');
        Route::post('events/editEvent/{id}', [EventController::class, 'update'])->name('admin.updateEvent');
        Route::get('events/delete/{id}', [EventController::class, 'delete'])->name('admin.deleteEvent');
        
        //Admin News Routes
        Route::get('events/news', [EventController::class, 'news'])->name('admin.news');

        //Admin Matches Routes
        Route::get('viewMatches', [MatchesController::class, 'admin_viewMatches'])->name('admin.matches');
        Route::get('matchDetails/{id}', [MatchesController::class, 'admin_matchDetails'])->name('admin.matchDetails');
        Route::post('matchGroundUpdate/{id}', [MatchesController::class, 'admin_matchGroundUpdate'])->name('admin.matchGroundUpdate');
        Route::post('matchWinningAnnounce/{id}', [MatchesController::class, 'admin_matchWinningAnnounce'])->name('admin.matchWinningAnnounce');
        
        
    });
});


Route::get('sessions', function(){
   echo '<pre>';
   print_r(session()->all());
   die;
});
