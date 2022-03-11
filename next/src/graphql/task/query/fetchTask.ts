import { gql } from '@apollo/client';
import type { Task } from 'models/task';

export const FETCH_TASKS_QUERY = gql`
  query FetchTask($page: Int) {
    tasks(first: 100, page: $page) {
      data {
        id
        title
        text
        user {
          name
        }
      }
      paginatorInfo {
        currentPage
        hasMorePages
        lastPage
      }
    }
  }
`;

export interface TaskData {
  tasks: Task[];
}
