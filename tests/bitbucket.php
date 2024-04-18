<?php

use Jaunt\Router;

include 'bootstrap.php';

$test_mem_start = memory_get_usage ();
$test_time_start = microtime ( true );

$router = new Router();

$router->get('/addon', 'callback');
$router->get('/addon/linkers', 'callback');
$router->get('/addon/linkers/:linker_key', 'callback');
$router->get('/addon/linkers/:linker_key/values', 'callback');
$router->get('/addon/linkers/:linker_key/values/:value_id', 'callback');
$router->get('/hook_events', 'callback');
$router->get('/hook_events/:subject_type', 'callback');
$router->get('/pullrequests/:selected_user', 'callback');
$router->get('/repositories', 'callback');
$router->get('/repositories/:workspace', 'callback');
$router->get('/repositories/:workspace/:repo_slug', 'callback');
$router->get('/repositories/:workspace/:repo_slug/branch-restrictions', 'callback');
$router->get('/repositories/:workspace/:repo_slug/branch-restrictions/:id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/branching-model', 'callback');
$router->get('/repositories/:workspace/:repo_slug/branching-model/settings', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/approve', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/comments', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/comments/:comment_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/properties/:app_key/:property_name', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/pullrequests', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/reports', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/reports/:reportId', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/reports/:reportId/annotations', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/reports/:reportId/annotations/:annotationId', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/statuses', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/statuses/build', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commit/:commit/statuses/build/:key', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commits', 'callback');
$router->get('/repositories/:workspace/:repo_slug/commits/:revision', 'callback');
$router->get('/repositories/:workspace/:repo_slug/components', 'callback');
$router->get('/repositories/:workspace/:repo_slug/components/:component_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/default-reviewers', 'callback');
$router->get('/repositories/:workspace/:repo_slug/default-reviewers/:target_username', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deploy-keys', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deploy-keys/:key_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deployments/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deployments/:deployment_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deployments_config/environments/:environment_uuid/variables', 'callback');
$router->get('/repositories/:workspace/:repo_slug/deployments_config/environments/:environment_uuid/variables/:variable_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/diff/:spec', 'callback');
$router->get('/repositories/:workspace/:repo_slug/diffstat/:spec', 'callback');
$router->get('/repositories/:workspace/:repo_slug/downloads', 'callback');
$router->get('/repositories/:workspace/:repo_slug/downloads/:filename', 'callback');
$router->get('/repositories/:workspace/:repo_slug/environments/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/environments/:environment_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/environments/:environment_uuid/changes/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/filehistory/:commit/:path', 'callback');
$router->get('/repositories/:workspace/:repo_slug/forks', 'callback');
$router->get('/repositories/:workspace/:repo_slug/hooks', 'callback');
$router->get('/repositories/:workspace/:repo_slug/hooks/:uid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/export', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/export/:repo_name-issues-:task_id.zip', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/import', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/attachments', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/attachments/:path', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/changes', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/changes/:change_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/comments', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/comments/:comment_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/vote', 'callback');
$router->get('/repositories/:workspace/:repo_slug/issues/:issue_id/watch', 'callback');
$router->get('/repositories/:workspace/:repo_slug/merge-base/:revspec', 'callback');
$router->get('/repositories/:workspace/:repo_slug/milestones', 'callback');
$router->get('/repositories/:workspace/:repo_slug/milestones/:milestone_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/patch/:spec', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines-config/caches/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines-config/caches/:cache_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines-config/caches/:cache_uuid/content-uri', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid/log', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid/logs/:log_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid/test_reports', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid/test_reports/test_cases', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/steps/:step_uuid/test_reports/test_cases/:test_case_uuid/test_case_reasons', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines/:pipeline_uuid/stopPipeline', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/build_number', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/schedules/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/schedules/:schedule_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/schedules/:schedule_uuid/executions/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/ssh/key_pair', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/ssh/known_hosts/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/ssh/known_hosts/:known_host_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/variables/', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pipelines_config/variables/:variable_uuid', 'callback');
$router->get('/repositories/:workspace/:repo_slug/properties/:app_key/:property_name', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/activity', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/activity', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/approve', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/comments', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/comments/:comment_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/commits', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/decline', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/diff', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/diffstat', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/merge', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/merge/task-status/:task_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/patch', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/request-changes', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pull_request_id/statuses', 'callback');
$router->get('/repositories/:workspace/:repo_slug/pullrequests/:pullrequest_id/properties/:app_key/:property_name', 'callback');
$router->get('/repositories/:workspace/:repo_slug/refs', 'callback');
$router->get('/repositories/:workspace/:repo_slug/refs/branches', 'callback');
$router->get('/repositories/:workspace/:repo_slug/refs/branches/:name', 'callback');
$router->get('/repositories/:workspace/:repo_slug/refs/tags', 'callback');
$router->get('/repositories/:workspace/:repo_slug/refs/tags/:name', 'callback');
$router->get('/repositories/:workspace/:repo_slug/src', 'callback');
$router->get('/repositories/:workspace/:repo_slug/src/:commit/:path', 'callback');
$router->get('/repositories/:workspace/:repo_slug/versions', 'callback');
$router->get('/repositories/:workspace/:repo_slug/versions/:version_id', 'callback');
$router->get('/repositories/:workspace/:repo_slug/watchers', 'callback');
$router->get('/snippets', 'callback');
$router->get('/snippets/:workspace', 'callback');
$router->get('/snippets/:workspace/:encoded_id', 'callback');
$router->get('/snippets/:workspace/:encoded_id/comments', 'callback');
$router->get('/snippets/:workspace/:encoded_id/comments/:comment_id', 'callback');
$router->get('/snippets/:workspace/:encoded_id/commits', 'callback');
$router->get('/snippets/:workspace/:encoded_id/commits/:revision', 'callback');
$router->get('/snippets/:workspace/:encoded_id/files/:path', 'callback');
$router->get('/snippets/:workspace/:encoded_id/watch', 'callback');
$router->get('/snippets/:workspace/:encoded_id/watchers', 'callback');
$router->get('/snippets/:workspace/:encoded_id/:node_id', 'callback');
$router->get('/snippets/:workspace/:encoded_id/:node_id/files/:path', 'callback');
$router->get('/snippets/:workspace/:encoded_id/:revision/diff', 'callback');
$router->get('/snippets/:workspace/:encoded_id/:revision/patch', 'callback');
$router->get('/teams', 'callback');
$router->get('/teams/:username', 'callback');
$router->get('/teams/:username/followers', 'callback');
$router->get('/teams/:username/following', 'callback');
$router->get('/teams/:username/members', 'callback');
$router->get('/teams/:username/permissions', 'callback');
$router->get('/teams/:username/permissions/repositories', 'callback');
$router->get('/teams/:username/permissions/repositories/:repo_slug', 'callback');
$router->get('/teams/:username/pipelines_config/variables/', 'callback');
$router->get('/teams/:username/pipelines_config/variables/:variable_uuid', 'callback');
$router->get('/teams/:username/projects/', 'callback');
$router->get('/teams/:username/projects/:project_key', 'callback');
$router->get('/teams/:username/search/code', 'callback');
$router->get('/teams/:workspace/repositories', 'callback');
$router->get('/user', 'callback');
$router->get('/user/emails', 'callback');
$router->get('/user/emails/:email', 'callback');
$router->get('/user/permissions/repositories', 'callback');
$router->get('/user/permissions/teams', 'callback');
$router->get('/user/permissions/workspaces', 'callback');
$router->get('/users/:selected_user', 'callback');
$router->get('/users/:selected_user/pipelines_config/variables/', 'callback');
$router->get('/users/:selected_user/pipelines_config/variables/:variable_uuid', 'callback');
$router->get('/users/:selected_user/properties/:app_key/:property_name', 'callback');
$router->get('/users/:selected_user/search/code', 'callback');
$router->get('/users/:selected_user/ssh-keys', 'callback');
$router->get('/users/:selected_user/ssh-keys/:key_id', 'callback');
$router->get('/users/:username/members', 'callback');
$router->get('/users/:workspace/repositories', 'callback');
$router->get('/workspaces', 'callback');
$router->get('/workspaces/:workspace', 'callback');
$router->get('/workspaces/:workspace/hooks', 'callback');
$router->get('/workspaces/:workspace/hooks/:uid', 'callback');
$router->get('/workspaces/:workspace/members', 'callback');
$router->get('/workspaces/:workspace/members/:member', 'callback');
$router->get('/workspaces/:workspace/permissions', 'callback');
$router->get('/workspaces/:workspace/permissions/repositories', 'callback');
$router->get('/workspaces/:workspace/permissions/repositories/:repo_slug', 'callback');
$router->get('/workspaces/:workspace/pipelines-config/identity/oidc/.well-known/openid-configuration', 'callback');
$router->get('/workspaces/:workspace/pipelines-config/identity/oidc/keys.json', 'callback');
$router->get('/workspaces/:workspace/pipelines-config/variables', 'callback');
$router->get('/workspaces/:workspace/pipelines-config/variables/:variable_uuid', 'callback');
$router->get('/workspaces/:workspace/projects', 'callback');
$router->get('/workspaces/:workspace/projects/:project_key', 'callback');
$router->get('/workspaces/:workspace/search/code', 'callback');

$route = $router->route('GET', '/workspaces/:workspace/search/code');
echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";
print_r($route);

return $router;