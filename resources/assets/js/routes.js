/**
 * Created by karim on 4/26/2018.
 */
import Home from './components/Home.vue';
import UsersTab from './components/users/UsersTab.vue';
import UserChat from './components/users/user/UserChat.vue';
import UserInfo from './components/users/user/UserInfo.vue';
import UserSettings from './components/users/user/UserSettings.vue';
import GroupsTab from './components/groups/GroupsTab.vue';
import GroupChat from './components/groups/group/GroupChat.vue';
import GroupInfo from './components/groups/Group/GroupInfo.vue';
import GroupSettings from './components/groups/group/GroupSettings.vue';

export default [
    {
        path: '/chat',
        name: 'home',
        component: Home,
        children: [
            {
                path: 'users',
                name: 'users',
                component: UsersTab,
            },
            {

                path: 'users/:user_id',
                component: UsersTab,
                children: [
                    {
                        path: '',
                        name: 'user',
                        component: UserChat,
                    },
                    {
                        path: 'info',
                        name: 'user_info',
                        component: UserInfo,
                    },
                    {
                        path: 'settings',
                        name: 'user_settings',
                        component: UserSettings,
                    }
                ]

            },
            {
                path: 'groups',
                name: 'groups',
                component: GroupsTab,
            },
            {
                path: 'groups/:group_id',
                component: GroupsTab,
                children: [
                    {
                        path: '',
                        name: 'group',
                        component: GroupChat,
                    },
                    {
                        path: 'profile',
                        name: 'group_info',
                        component: GroupInfo,
                    },
                    {
                        path: 'settings',
                        name: 'group_settings',
                        component: GroupSettings,
                    }
                ]

            },
        ]
    },
];