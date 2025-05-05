import axios from "axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        boardDetail: null,
        userList: [],
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        // setBoardListUnshift(state, board) {
        //     state.boardList.unshift(board);
        // },
        setUserList(state, userList) {
            state.userList = userList;
        },


    },
    actions: {
        // 프로젝트 획득
        indexBoard(context, data) {
            const url = '/api/boards/';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                context.commit('setBoardList', response.data.boardList);
                // console.log('🟢 API 응답 도착:', response.data);
            })
            .catch(error => {
                console.log("API 호출 실패");
                console.log(error);
            });
        },
        // 프로젝트 상태변경
        updateStatus(context, project) {
            const url = `/api/boards/${project.project_id}/status`;
            const config = {
              headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                'Content-Type': 'application/json',
              }
            }
          
            axios.post(url, { status: project.status }, config)
              .then(response => {
                console.log("상태 변경 완료", response.data);
              })
              .catch(error => {
                console.error("상태 변경 실패", error);
              });
          },

        // 프로젝트 상세(task)
        showBoard(context, id) {
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setBoardDetail', response.data.board);
            })
            .catch(error => {
                console.log(error);
            }); 
        },
        // 프로젝트 생성
        storeBoard(context, data) {
            const url = '/api/boards/store';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            // form data  생성
            const formData = new FormData();
            formData.append('title', data.title);
            formData.append('description', data.description);


            axios.post(url, formData, config)
            .then(response => {
                // context.commit('setBoardListUnshift', response.data.board);
                router.replace('/boards');
            })
            .catch(error => {
                console.log(error);
            });
        },

        indexUser(context, data) {
            const url = '/api/users/';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                context.commit('setUserList', response.data.userList);
                console.log('🟢 API 응답 도착:', response.data.userList);
            })
            .catch(error => {
                console.log(error);
            });
        }


    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}